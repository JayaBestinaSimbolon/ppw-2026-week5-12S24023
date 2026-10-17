<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login Pustakawan SIPUS-Del.
     * Mengambil email terakhir dari cookie terenkripsi yang tersimpan di browser.
     */
    public function showLoginForm(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('katalog')->with('info', 'Anda sudah berada dalam sesi aktif.');
        }

        // Ambil nilai cookie del_last_user_email untuk kemudahan pengisian form login
        $savedEmail = $request->cookie('del_last_user_email', '');

        return view('auth.login', compact('savedEmail'));
    }

    /**
     * Memproses otentikasi login Pustakawan.
     * Menerapkan Auth::attempt, regenerasi Session ID (Anti-Session Fixation),
     * penyimpanan state sesi, serta pembuatan HTTP Cookie aman.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required'    => 'Alamat email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            // WAJIB: Regenerasi ID Sesi untuk mencegah serangan Session Fixation
            $request->session()->regenerate();

            // Simpan state sesi pengguna aktif
            session([
                'login_timestamp'  => now()->format('d M Y, H:i:s') . ' WIB',
                'pustakawan_name'  => Auth::user()->name,
                'pustakawan_email' => Auth::user()->email,
            ]);

            // Buat HTTP Cookie aman untuk mengingat email terakhir pustakawan (10080 menit = 7 hari)
            // Dilindungi HttpOnly dan SameSite=Lax secara default oleh konfigurasi Laravel
            Cookie::queue('del_last_user_email', $request->email, 10080);

            return redirect()->intended(route('katalog'))
                ->with('success', 'Sesi Anda telah aktif. Selamat datang kembali, ' . Auth::user()->name . '!');
        }

        return back()
            ->withInput($request->only('email', 'remember'))
            ->with('error', 'Kredensial login tidak valid. Pastikan email dan password Anda benar.');
    }

    /**
     * Memproses logout Pustakawan dengan menghancurkan sesi dan meregenerasi token CSRF.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate seluruh data sesi server
        $request->session()->invalidate();

        // Regenerasi token CSRF untuk keamanan request berikutnya
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Sesi server telah dihapus dengan aman.');
    }
}
