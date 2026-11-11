<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Memproses otentikasi login API & menghasilkan Bearer Token Sanctum.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        // Validasi kecocokan email dan password
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Kredensial login tidak valid. Pastikan email dan password Anda benar.'
            ], 401);
        }

        // Hapus token lama (opsional, agar bersih) atau buat token baru
        $token = $user->createToken('AuthToken')->plainTextToken;

        return response()->json([
            'message'      => 'Login berhasil. Selamat datang kembali, ' . $user->name . '!',
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'user'         => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
            ]
        ], 200);
    }

    /**
     * Memproses logout API (menghapus token aktif).
     */
    public function logout(Request $request)
    {
        // Menghapus token yang sedang digunakan saat request
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Token akses berhasil dicabut (Logout berhasil).'
        ], 200);
    }
}