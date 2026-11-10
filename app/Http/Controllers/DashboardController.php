<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman beranda / dashboard utama perpustakaan.
     */
    public function index()
    {
        return view('dashboard', [
            'totalBuku'         => Buku::count(),
            'totalStok'         => Buku::sum('stok'),
            'bukuDipinjam'      => Peminjaman::where('status', 'dipinjam')->count(),
            'totalDikembalikan' => Peminjaman::where('status', 'dikembalikan')->count(),
            'kategoris'         => Kategori::take(6)->get(),
            'bukus'             => Buku::latest()->take(4)->get(),
        ]);
    }
}