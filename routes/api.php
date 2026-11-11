<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BukuController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rute Login API langsung (Tanpa perlu Controller Auth terpisah)
Route::post('/v1/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'Kredensial login tidak valid.'
        ], 401);
    }

    $token = $user->createToken('AuthToken')->plainTextToken;

    return response()->json([
        'message' => 'Login berhasil.',
        'access_token' => $token,
        'token_type' => 'Bearer',
        'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]
    ], 200);
});

// ==========================================
// RUTE SIPUS-DEL (Bebas Token untuk Uji Coba)
// ==========================================
Route::prefix('v1')->group(function () {
    Route::apiResource('bukus', BukuController::class);
});