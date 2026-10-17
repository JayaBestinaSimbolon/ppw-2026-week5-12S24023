<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Halaman direktori layanan perpustakaan Institut Teknologi Del.
     */
    public function index()
    {
        return view('layanan.index');
    }

    /**
     * Halaman panduan dan bantuan penggunaan perpustakaan.
     */
    public function bantuan()
    {
        return view('layanan.bantuan');
    }

    /**
     * Halaman tentang perpustakaan SIPUS-Del.
     */
    public function tentang()
    {
        return view('layanan.tentang');
    }
}
