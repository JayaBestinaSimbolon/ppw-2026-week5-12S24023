<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BukuController; // Sesuaikan dengan namespace controller Anda jika berbeda

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ==========================================
// RUTE SIPUS-DEL (Bebas Token untuk Uji Coba)
// ==========================================
Route::prefix('v1')->group(function () {
    // Rute Buku (GET, POST, PUT, PATCH, DELETE)
    Route::apiResource('bukus', BukuController::class);
});

use App\Http\Controllers\Api\AuthController; // Sesuaikan dengan controller auth Anda

// Tambahkan rute login ini di dalam routes/api.php
Route::post('/v1/login', [AuthController::class, 'login']);