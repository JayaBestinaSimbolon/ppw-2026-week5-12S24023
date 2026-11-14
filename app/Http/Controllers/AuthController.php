<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function showLoginForm(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('katalog')->with('info', 'Anda sudah berada dalam sesi aktif.');
        }

        $savedEmail = $request->cookie('del_last_user_email', '');

        return view('auth.login', compact('savedEmail'));
    }

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
            $request->session()->regenerate();

            session([
                'login_timestamp'  => now()->format('d M Y, H:i:s') . ' WIB',
                'pustakawan_name'  => Auth::user()->name,
                'pustakawan_email' => Auth::user()->email,
            ]);

            Cookie::queue('del_last_user_email', $request->email, 10080);

            return redirect()->intended(route('katalog'))
                ->with('success', 'Sesi Anda telah aktif. Selamat datang kembali, ' . Auth::user()->name . '!');
        }

        return back()
            ->withInput($request->only('email', 'remember'))
            ->with('error', 'Kredensial login tidak valid. Pastikan email dan password Anda benar.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Sesi server telah dihapus dengan aman.');
    }
}