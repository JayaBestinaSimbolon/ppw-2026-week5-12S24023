<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik Menggunakan Fluent Query Builder (DB::table) Sesuai Rubrik Week 6
        $totalBuku       = DB::table('bukus')->count();
        $totalKategori   = DB::table('kategoris')->count();
        $totalStok       = (int) DB::table('bukus')->sum('stok');
        $bukuStokHabis   = DB::table('bukus')->where('stok', '<=', 0)->count();
        $sedangDipinjam  = DB::table('peminjamans')->where('status', 'dipinjam')->count();
        $sudahKembali    = DB::table('peminjamans')->where('status', 'dikembalikan')->count();

        // Statistik koleksi per lantai
        $totalLantai1    = DB::table('bukus')->where('lantai', 1)->count();
        $totalLantai2    = DB::table('bukus')->where('lantai', 2)->count();

        // Kategori terpopuler dengan jumlah buku (withCount bukus)
        $kategoris       = Kategori::withCount('bukus')->orderBy('nama_kategori')->take(8)->get();

        // Buku terbaru dengan eager loading relasi kategori dan hitungan peminjaman
        $bukuTerbaru     = Buku::with('kategori')->withCount('peminjamans')->latest()->take(6)->get();

        return view('dashboard', compact(
            'totalBuku',
            'totalKategori',
            'totalStok',
            'bukuStokHabis',
            'sedangDipinjam',
            'sudahKembali',
            'totalLantai1',
            'totalLantai2',
            'kategoris',
            'bukuTerbaru'
        ));
    }
}
