<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthTokenController;
use App\Http\Controllers\Api\V1\BukuApiController;
use App\Http\Controllers\Api\V1\PeminjamanApiController;

Route::prefix('v1')->group(function () {

    // ==========================================
    // 1. ENDPOINT PUBLIK (Tanpa Token)
    // ==========================================
    Route::post('/auth/login', [AuthTokenController::class, 'login']);
    
    // Katalog Buku (Read-Only)
    Route::get('/bukus', [BukuApiController::class, 'index']);
    Route::get('/bukus/{identifier}', [BukuApiController::class, 'show']);

    // ==========================================
    // 2. ENDPOINT TERPROTEKSI (Wajib Bearer Token)
    // ==========================================
    Route::middleware('auth:sanctum')->group(function () {
        // Auth Check & Logout
        Route::get('/auth/me', [AuthTokenController::class, 'me']);
        Route::post('/auth/logout', [AuthTokenController::class, 'logout']);

        // Mutasi Katalog Buku (POST, PUT, PATCH, DELETE)
        Route::post('/bukus', [BukuApiController::class, 'store']);
        Route::put('/bukus/{id}', [BukuApiController::class, 'update']);
        Route::patch('/bukus/{id}', [BukuApiController::class, 'update']);
        Route::delete('/bukus/{id}', [BukuApiController::class, 'destroy']);

        // Sirkulasi Peminjaman Buku
        Route::get('/peminjamans', [PeminjamanApiController::class, 'index']);
        Route::post('/peminjamans', [PeminjamanApiController::class, 'store']);
        Route::patch('/peminjamans/{id}/kembalikan', [PeminjamanApiController::class, 'kembalikan']);
    });

});

use App\Http\Controllers\AuthController; // Sesuaikan dengan lokasi controller login Anda

Route::post('/login', [AuthController::class, 'login']);

use App\Http\Controllers\KatalogController; // Sesuaikan dengan Controller Anda

Route::get('/katalog', [KatalogController::class, 'index']);