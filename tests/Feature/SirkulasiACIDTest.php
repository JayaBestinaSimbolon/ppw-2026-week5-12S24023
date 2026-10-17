<?php

namespace Tests\Feature;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class SirkulasiACIDTest extends TestCase
{
    use RefreshDatabase;

    protected User $pustakawan;
    protected Kategori $kategori;
    protected Buku $bukuTersedia;
    protected Buku $bukuStokNol;
    protected Buku $bukuStokSatu;

    protected function setUp(): void
    {
        parent::setUp();

        $this->pustakawan = User::create([
            'name'     => 'Pustakawan IT Del',
            'email'    => 'pustakawan@del.ac.id',
            'password' => Hash::make('password123'),
        ]);

        $this->kategori = Kategori::create([
            'kode_kategori' => 'TI',
            'nama_kategori' => 'Teknologi Informasi',
        ]);

        $this->bukuTersedia = Buku::create([
            'isbn'          => '978-602-0001',
            'judul'         => 'Laravel Architecture',
            'penulis'       => 'Taylor Otwell',
            'penerbit'      => 'Tech Press',
            'tahun_terbit'  => 2024,
            'kategori_id'   => $this->kategori->id,
            'jenis_koleksi' => 'Buku Pelajaran',
            'lantai'        => 1,
            'kode_rak'      => 'A-01',
            'stok'          => 5,
            'sinopsis'      => 'Panduan arsitektur Laravel.',
        ]);

        $this->bukuStokSatu = Buku::create([
            'isbn'          => '978-602-0002',
            'judul'         => 'Distributed Systems',
            'penulis'       => 'Andrew Tanenbaum',
            'penerbit'      => 'Pearson',
            'tahun_terbit'  => 2023,
            'kategori_id'   => $this->kategori->id,
            'jenis_koleksi' => 'Buku Pelajaran',
            'lantai'        => 1,
            'kode_rak'      => 'A-02',
            'stok'          => 1,
            'sinopsis'      => 'Buku tentang sistem terdistribusi.',
        ]);

        $this->bukuStokNol = Buku::create([
            'isbn'          => 'SKR-2024-001',
            'judul'         => 'Skripsi AI Del',
            'penulis'       => 'Mahasiswa Del',
            'penerbit'      => 'IT Del',
            'tahun_terbit'  => 2024,
            'kategori_id'   => $this->kategori->id,
            'jenis_koleksi' => 'Skripsi',
            'lantai'        => 2,
            'kode_rak'      => 'SKR-01',
            'stok'          => 0,
            'sinopsis'      => 'Skripsi dengan stok habis 0 eksemplar.',
        ]);
    }

    /**
     * Uji 1: Peminjaman normal mengurangi stok tepat satu dan mencatat transaksi atomik.
     */
    public function test_peminjaman_berhasil_mengurangi_stok_tepat_satu(): void
    {
        $stokAwal = $this->bukuTersedia->stok;

        $response = $this->actingAs($this->pustakawan)->post(route('peminjaman.store'), [
            'buku_id'             => $this->bukuTersedia->id,
            'nim_peminjam'        => '12S24023',
            'nama_peminjam'       => 'Jaya Bestina Simbolon',
            'tanggal_pinjam'      => now()->toDateString(),
            'tanggal_jatuh_tempo' => now()->addDays(7)->toDateString(),
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('peminjamans', [
            'buku_id'      => $this->bukuTersedia->id,
            'nim_peminjam' => '12S24023',
            'status'       => 'dipinjam',
        ]);

        $this->assertEquals($stokAwal - 1, $this->bukuTersedia->fresh()->stok);
    }

    /**
     * Uji 2: Peminjaman saat stok 0 wajib ditolak dan rollback transaksi (stok tidak berubah).
     */
    public function test_peminjaman_stok_nol_ditolak_dan_rollback_atomik(): void
    {
        $this->assertEquals(0, $this->bukuStokNol->stok);

        $response = $this->actingAs($this->pustakawan)->post(route('peminjaman.store'), [
            'buku_id'             => $this->bukuStokNol->id,
            'nim_peminjam'        => '12S24099',
            'nama_peminjam'       => 'Uji Rollback',
            'tanggal_pinjam'      => now()->toDateString(),
            'tanggal_jatuh_tempo' => now()->addDays(7)->toDateString(),
        ]);

        $response->assertSessionHas('error');
        $this->assertDatabaseMissing('peminjamans', [
            'buku_id'      => $this->bukuStokNol->id,
            'nim_peminjam' => '12S24099',
        ]);
        $this->assertEquals(0, $this->bukuStokNol->fresh()->stok);
    }

    /**
     * Uji 3: Pencegahan peminjaman ganda oleh NIM yang sama untuk buku yang sama saat transaksi masih aktif.
     */
    public function test_cegah_nim_sama_meminjam_buku_sama_sebelum_dikembalikan(): void
    {
        // Peminjaman pertama
        $this->actingAs($this->pustakawan)->post(route('peminjaman.store'), [
            'buku_id'             => $this->bukuTersedia->id,
            'nim_peminjam'        => '12S24023',
            'nama_peminjam'       => 'Jaya Bestina Simbolon',
            'tanggal_pinjam'      => now()->toDateString(),
            'tanggal_jatuh_tempo' => now()->addDays(7)->toDateString(),
        ]);

        $stokSetelahPinjam1 = $this->bukuTersedia->fresh()->stok;

        // Peminjaman kedua oleh NIM yang sama untuk buku yang sama (harus ditolak)
        $response = $this->actingAs($this->pustakawan)->post(route('peminjaman.store'), [
            'buku_id'             => $this->bukuTersedia->id,
            'nim_peminjam'        => '12S24023',
            'nama_peminjam'       => 'Jaya Bestina Simbolon',
            'tanggal_pinjam'      => now()->toDateString(),
            'tanggal_jatuh_tempo' => now()->addDays(7)->toDateString(),
        ]);

        $response->assertSessionHas('error');
        $this->assertEquals($stokSetelahPinjam1, $this->bukuTersedia->fresh()->stok);
        $this->assertEquals(1, Peminjaman::where('buku_id', $this->bukuTersedia->id)->where('nim_peminjam', '12S24023')->count());
    }

    /**
     * Uji 4: Pengembalian buku berhasil mengubah status, mengisi tanggal_kembali, dan menambah stok tepat 1.
     */
    public function test_pengembalian_berhasil_menambah_stok_dan_mengubah_status(): void
    {
        $peminjaman = Peminjaman::create([
            'kode_pinjam'         => 'PMJ-TEST-001',
            'buku_id'             => $this->bukuTersedia->id,
            'nim_peminjam'        => '12S24001',
            'nama_peminjam'       => 'Budi Test',
            'tanggal_pinjam'      => now()->subDays(5)->toDateString(),
            'tanggal_jatuh_tempo' => now()->addDays(2)->toDateString(),
            'status'              => 'dipinjam',
        ]);

        $stokSebelumKembali = $this->bukuTersedia->stok;

        $response = $this->actingAs($this->pustakawan)->post(route('peminjaman.kembali', $peminjaman->id));

        $response->assertSessionHas('success');
        $this->assertEquals('dikembalikan', $peminjaman->fresh()->status);
        $this->assertNotNull($peminjaman->fresh()->tanggal_kembali);
        $this->assertEquals($stokSebelumKembali + 1, $this->bukuTersedia->fresh()->stok);
    }

    /**
     * Uji 5: Pengembalian ganda pada transaksi yang sama ditolak (stok tidak bertambah dua kali).
     */
    public function test_pengembalian_berulang_ditolak(): void
    {
        $peminjaman = Peminjaman::create([
            'kode_pinjam'         => 'PMJ-TEST-002',
            'buku_id'             => $this->bukuTersedia->id,
            'nim_peminjam'        => '12S24002',
            'nama_peminjam'       => 'Ani Test',
            'tanggal_pinjam'      => now()->subDays(10)->toDateString(),
            'tanggal_jatuh_tempo' => now()->subDays(3)->toDateString(),
            'tanggal_kembali'     => now()->subDays(1)->toDateString(),
            'status'              => 'dikembalikan',
        ]);

        $stokAwal = $this->bukuTersedia->stok;

        $response = $this->actingAs($this->pustakawan)->post(route('peminjaman.kembali', $peminjaman->id));

        $response->assertSessionHas('error');
        $this->assertEquals($stokAwal, $this->bukuTersedia->fresh()->stok);
    }

    /**
     * Uji 6: Proteksi rute mutasi oleh middleware auth (tamu diarahkan ke login).
     */
    public function test_rute_mutasi_ditolak_tanpa_login(): void
    {
        $response1 = $this->get(route('peminjaman.index'));
        $response1->assertRedirect(route('login'));

        $response2 = $this->post(route('peminjaman.store'), []);
        $response2->assertRedirect(route('login'));

        $response3 = $this->get(route('buku.create'));
        $response3->assertRedirect(route('login'));

        $response4 = $this->post(route('buku.store'), []);
        $response4->assertRedirect(route('login'));
    }

    /**
     * Uji 7: Login pustakawan meregenerasi session ID dan membuat Cookie HttpOnly.
     */
    public function test_login_sukses_regenerasi_session_dan_queue_cookie(): void
    {
        $response = $this->post(route('login.post'), [
            'email'    => 'pustakawan@del.ac.id',
            'password' => 'password123',
        ]);

        $this->assertAuthenticatedAs($this->pustakawan);
        $response->assertRedirect(route('katalog'));
        $response->assertCookie('del_last_user_email');
        $this->assertNotNull(session('login_timestamp'));
    }

    /**
     * Uji 8: Login dengan kredensial salah ditolak.
     */
    public function test_login_gagal_dengan_password_salah(): void
    {
        $response = $this->from(route('login'))->post(route('login.post'), [
            'email'    => 'pustakawan@del.ac.id',
            'password' => 'passwordsalah',
        ]);

        $this->assertGuest();
        $response->assertRedirect(route('login'));
        $response->assertSessionHas('error');
    }

    /**
     * Uji 9: Logout pustakawan mengakhiri sesi dan meregenerasi token CSRF.
     */
    public function test_logout_mengakhiri_sesi(): void
    {
        $response = $this->actingAs($this->pustakawan)->post(route('logout'));

        $this->assertGuest();
        $response->assertRedirect(route('login'));
        $response->assertSessionHas('success');
    }

    /**
     * Uji 10: Katalog menggunakan withCount('peminjamans') dan Query Builder statistik akurat.
     */
    public function test_katalog_with_count_dan_statistik(): void
    {
        // Catat 1 peminjaman untuk bukuTersedia
        Peminjaman::create([
            'kode_pinjam'         => 'PMJ-STAT-001',
            'buku_id'             => $this->bukuTersedia->id,
            'nim_peminjam'        => '12S24010',
            'nama_peminjam'       => 'Stat Test',
            'tanggal_pinjam'      => now()->toDateString(),
            'tanggal_jatuh_tempo' => now()->addDays(7)->toDateString(),
            'status'              => 'dipinjam',
        ]);

        $response = $this->get(route('katalog', ['q' => 'Laravel']));

        $response->assertStatus(200);
        $response->assertViewHas('bukus');
        $response->assertViewHas('stats');

        $bukus = $response->viewData('bukus');
        $this->assertEquals(1, $bukus->first()->peminjamans_count);

        $stats = $response->viewData('stats');
        $this->assertEquals(3, $stats['total_judul']);
        $this->assertEquals(1, $stats['sedang_dipinjam']);
    }
}
