<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Database\Seeder;

class PeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Membuat sampel data peminjaman buku (status dipinjam dan dikembalikan).
     * Menggunakan updateOrCreate agar aman dijalankan berulang kali tanpa duplikasi data.
     */
    public function run(): void
    {
        $buku1 = Buku::where('stok', '>', 0)->first();
        $buku2 = Buku::where('stok', '>', 0)->skip(1)->first();

        if ($buku1) {
            // Sampel 1: Transaksi Peminjaman Aktif (status: dipinjam)
            Peminjaman::updateOrCreate(
                ['kode_pinjam' => 'PMJ-20261015-001'],
                [
                    'buku_id'             => $buku1->id,
                    'nim_peminjam'        => '12S24023',
                    'nama_peminjam'       => 'Jaya Bestina Simbolon',
                    'tanggal_pinjam'      => now()->subDays(3)->toDateString(),
                    'tanggal_jatuh_tempo' => now()->addDays(4)->toDateString(),
                    'tanggal_kembali'     => null,
                    'status'              => 'dipinjam',
                ]
            );
        }

        if ($buku2) {
            // Sampel 2: Transaksi Peminjaman Selesai (status: dikembalikan)
            Peminjaman::updateOrCreate(
                ['kode_pinjam' => 'PMJ-20261010-002'],
                [
                    'buku_id'             => $buku2->id,
                    'nim_peminjam'        => '12S24001',
                    'nama_peminjam'       => 'Budi Setiawan',
                    'tanggal_pinjam'      => now()->subDays(10)->toDateString(),
                    'tanggal_jatuh_tempo' => now()->subDays(3)->toDateString(),
                    'tanggal_kembali'     => now()->subDays(2)->toDateString(),
                    'status'              => 'dikembalikan',
                ]
            );
        }
    }
}
