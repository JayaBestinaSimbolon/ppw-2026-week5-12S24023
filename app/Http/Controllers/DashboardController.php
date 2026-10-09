<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBuku      = Buku::count();
        $totalKategori  = Kategori::count();
        $totalStok      = Buku::sum('stok');
        $bukuStokHabis  = Buku::where('stok', 0)->count();
        $bukuTerbaru    = Buku::with('kategori')->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalBuku',
            'totalKategori',
            'totalStok',
            'bukuStokHabis',
            'bukuTerbaru'
        ));
    }
}
