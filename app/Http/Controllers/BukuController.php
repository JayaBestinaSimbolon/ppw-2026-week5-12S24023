<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource (Katalog & Pencarian & Filter Lokasi).
     * Terbuka untuk umum maupun admin.
     */
    public function index(Request $request)
    {
        // Simpan riwayat kata kunci pencarian ke session state
        if ($request->filled('q')) {
            session(['last_buku_search' => $request->q]);
        }

        $filters = [
            'q'             => $request->input('q'),
            'kategori'      => $request->input('kategori'),
            'jenis_koleksi' => $request->input('jenis_koleksi'),
            'lantai'        => $request->input('lantai'),
            'ketersediaan'  => $request->input('ketersediaan'),
            'sort'          => $request->input('sort', 'latest'),
        ];

        // Eager loading kategori dan hitungan relasi peminjaman untuk mencegah masalah N+1 query
        $query = Buku::with('kategori')
            ->withCount('peminjamans')
            ->filter($filters);

        // Pengurutan
        switch ($filters['sort']) {
            case 'judul_asc':
                $query->orderBy('judul', 'asc');
                break;
            case 'judul_desc':
                $query->orderBy('judul', 'desc');
                break;
            case 'tahun_desc':
                $query->orderBy('tahun_terbit', 'desc');
                break;
            case 'tahun_asc':
                $query->orderBy('tahun_terbit', 'asc');
                break;
            case 'stok_desc':
                $query->orderBy('stok', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        $bukus = $query->paginate(12)->withQueryString();
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        // Statistik perpustakaan menggunakan Fluent Query Builder (DB::table)
        $stats = [
            'total_judul'     => \Illuminate\Support\Facades\DB::table('bukus')->count(),
            'total_stok'      => (int) \Illuminate\Support\Facades\DB::table('bukus')->sum('stok'),
            'sedang_dipinjam' => \Illuminate\Support\Facades\DB::table('peminjamans')->where('status', 'dipinjam')->count(),
            'dikembalikan'    => \Illuminate\Support\Facades\DB::table('peminjamans')->where('status', 'dikembalikan')->count(),
        ];

        // Mode tampilan: admin table atau catalog grid
        $viewMode = $request->input('view', 'catalog');

        return view('buku.index', compact('bukus', 'kategoris', 'filters', 'viewMode', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        return view('buku.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'isbn'          => 'required|string|unique:bukus,isbn',
            'judul'         => 'required|string|min:3',
            'penulis'       => 'required|string',
            'penerbit'      => 'required|string',
            'tahun_terbit'  => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'kategori_id'   => 'required|exists:kategoris,id',
            'jenis_koleksi' => 'required|in:Buku Pelajaran,Skripsi',
            'lantai'        => 'required|in:1,2',
            'kode_rak'      => 'nullable|string|max:50',
            'stok'          => 'required|integer|min:0',
            'sinopsis'      => 'nullable|string',
        ], [
            'isbn.required'          => 'ISBN / Kode Dokumen wajib diisi.',
            'isbn.unique'            => 'ISBN sudah terdaftar di sistem.',
            'judul.required'         => 'Judul buku wajib diisi.',
            'judul.min'              => 'Judul buku minimal 3 karakter.',
            'penulis.required'       => 'Nama penulis wajib diisi.',
            'penerbit.required'      => 'Nama penerbit / institusi wajib diisi.',
            'tahun_terbit.required'  => 'Tahun terbit wajib diisi.',
            'kategori_id.required'   => 'Kategori wajib dipilih.',
            'kategori_id.exists'     => 'Kategori yang dipilih tidak valid.',
            'jenis_koleksi.required' => 'Jenis koleksi wajib dipilih.',
            'jenis_koleksi.in'       => 'Jenis koleksi harus Buku Pelajaran atau Skripsi.',
            'lantai.required'        => 'Lantai lokasi wajib dipilih.',
            'lantai.in'              => 'Lantai harus 1 atau 2.',
            'stok.required'          => 'Stok wajib diisi.',
            'stok.min'               => 'Stok tidak boleh negatif.',
        ]);

        // Konsistensi aturan lokasi:
        // Buku Pelajaran di lantai 1, Skripsi di lantai 2
        if ($validated['jenis_koleksi'] === 'Buku Pelajaran' && (int)$validated['lantai'] !== 1) {
            return back()->withInput()->withErrors([
                'lantai' => 'Aturan perpustakaan: Buku Pelajaran wajib dialokasikan di Lantai 1.'
            ]);
        }
        if ($validated['jenis_koleksi'] === 'Skripsi' && (int)$validated['lantai'] !== 2) {
            return back()->withInput()->withErrors([
                'lantai' => 'Aturan perpustakaan: Koleksi Skripsi wajib dialokasikan di Lantai 2.'
            ]);
        }

        Buku::create($validated);

        return redirect()->route('buku.index', ['view' => 'manage'])
            ->with('success', 'Buku "' . $validated['judul'] . '" berhasil ditambahkan ke koleksi perpustakaan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Buku $buku)
    {
        $buku->load('kategori');
        
        // Buku terkait dalam kategori yang sama
        $bukuTerkait = Buku::where('kategori_id', $buku->kategori_id)
            ->where('id', '!=', $buku->id)
            ->take(4)
            ->get();

        return view('buku.show', compact('buku', 'bukuTerkait'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buku $buku)
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        return view('buku.edit', compact('buku', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buku $buku)
    {
        $validated = $request->validate([
            'isbn'          => 'required|string|unique:bukus,isbn,' . $buku->id,
            'judul'         => 'required|string|min:3',
            'penulis'       => 'required|string',
            'penerbit'      => 'required|string',
            'tahun_terbit'  => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'kategori_id'   => 'required|exists:kategoris,id',
            'jenis_koleksi' => 'required|in:Buku Pelajaran,Skripsi',
            'lantai'        => 'required|in:1,2',
            'kode_rak'      => 'nullable|string|max:50',
            'stok'          => 'required|integer|min:0',
            'sinopsis'      => 'nullable|string',
        ], [
            'isbn.required'          => 'ISBN / Kode Dokumen wajib diisi.',
            'isbn.unique'            => 'ISBN sudah digunakan oleh buku lain.',
            'judul.required'         => 'Judul buku wajib diisi.',
            'judul.min'              => 'Judul buku minimal 3 karakter.',
            'penulis.required'       => 'Nama penulis wajib diisi.',
            'penerbit.required'      => 'Nama penerbit / institusi wajib diisi.',
            'tahun_terbit.required'  => 'Tahun terbit wajib diisi.',
            'kategori_id.required'   => 'Kategori wajib dipilih.',
            'jenis_koleksi.required' => 'Jenis koleksi wajib dipilih.',
            'lantai.required'        => 'Lantai lokasi wajib dipilih.',
            'stok.required'          => 'Stok wajib diisi.',
            'stok.min'               => 'Stok tidak boleh negatif.',
        ]);

        // Validasi konsistensi aturan perpustakaan
        if ($validated['jenis_koleksi'] === 'Buku Pelajaran' && (int)$validated['lantai'] !== 1) {
            return back()->withInput()->withErrors([
                'lantai' => 'Aturan perpustakaan: Buku Pelajaran wajib dialokasikan di Lantai 1.'
            ]);
        }
        if ($validated['jenis_koleksi'] === 'Skripsi' && (int)$validated['lantai'] !== 2) {
            return back()->withInput()->withErrors([
                'lantai' => 'Aturan perpustakaan: Koleksi Skripsi wajib dialokasikan di Lantai 2.'
            ]);
        }

        $buku->update($validated);

        return redirect()->route('buku.show', $buku)
            ->with('success', 'Data buku "' . $buku->judul . '" berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buku $buku)
    {
        $judul = $buku->judul;
        $buku->delete();

        return redirect()->route('buku.index', ['view' => 'manage'])
            ->with('success', 'Buku "' . $judul . '" berhasil dihapus dari koleksi perpustakaan.');
    }
}
