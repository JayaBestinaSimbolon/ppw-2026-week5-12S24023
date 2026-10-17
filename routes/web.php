<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\TurnitinController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — SIPUS-Del
| Sistem Informasi Perpustakaan Institut Teknologi Del
|--------------------------------------------------------------------------
*/

// =========================================================================
// 1. RUTE PUBLIK (Dapat Diakses Oleh Mahasiswa & Tamu Tanpa Login)
// =========================================================================

// Beranda & Katalog
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/katalog', [BukuController::class, 'index'])->name('katalog');
Route::get('/buku/{buku}', [BukuController::class, 'show'])->name('buku.show');

// Kategori Koleksi (Read-Only Publik)
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori/{kategori}', [KategoriController::class, 'show'])->name('kategori.show');

// Layanan Informasi & Pengajuan Turnitin
Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
Route::get('/layanan/bantuan', [LayananController::class, 'bantuan'])->name('layanan.bantuan');
Route::get('/tentang', [LayananController::class, 'tentang'])->name('tentang');
Route::get('/turnitin', [TurnitinController::class, 'index'])->name('turnitin.index');
Route::post('/turnitin', [TurnitinController::class, 'store'])->name('turnitin.store');

// Autentikasi Pustakawan
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =========================================================================
// 2. RUTE MUTASI & ADMINISTRASI (Diproteksi Penuh Oleh Middleware 'auth')
// =========================================================================
Route::middleware('auth')->group(function () {
    // Mode Pengelolaan Buku & Mutasi CRUD
    Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
    Route::get('/buku-baru/create', [BukuController::class, 'create'])->name('buku.create');
    Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
    Route::get('/buku/{buku}/edit', [BukuController::class, 'edit'])->name('buku.edit');
    Route::match(['put', 'patch'], '/buku/{buku}', [BukuController::class, 'update'])->name('buku.update');
    Route::delete('/buku/{buku}', [BukuController::class, 'destroy'])->name('buku.destroy');

    // Mutasi CRUD Kategori
    Route::get('/kategori-baru/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{kategori}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::match(['put', 'patch'], '/kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

    // Sirkulasi Peminjaman & Pengembalian Buku (ACID & Concurrency Locking)
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    Route::post('/peminjaman/{id}/kembali', [PeminjamanController::class, 'kembali'])->name('peminjaman.kembali');
});
