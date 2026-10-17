<x-layout title="Login Pustakawan">

    <div class="sipus-container sipus-content-wrap" style="max-width: 520px; margin: 2rem auto;">
        <div class="sipus-card" style="border-top: 5px solid var(--sipus-primary); padding: 2.25rem 2rem;">
            {{-- Header Form --}}
            <div style="text-align: center; margin-bottom: 2rem;">
                <div class="sipus-brand-icon" style="margin: 0 auto 1rem auto; width: 54px; height: 54px; display: flex; align-items: center; justify-content: center; background: var(--sipus-primary-pale); color: var(--sipus-primary); border-radius: 12px;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="30" height="30">
                        <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" />
                    </svg>
                </div>
                <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--sipus-text); margin: 0 0 0.5rem 0;">
                    Login Pustakawan
                </h1>
                <p style="font-size: 0.875rem; color: var(--sipus-text-muted); margin: 0;">
                    Masuk untuk mengelola sirkulasi peminjaman, katalog buku, dan data kategori
                </p>
            </div>

            {{-- Formulir Login --}}
            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                {{-- Email --}}
                <div style="margin-bottom: 1.25rem;">
                    <label for="email" class="sipus-filter-label" style="font-weight: 600; margin-bottom: 0.35rem;">
                        Alamat Email Pustakawan <span style="color: var(--sipus-danger);">*</span>
                    </label>
                    <input type="email"
                           name="email"
                           id="email"
                           class="sipus-input"
                           placeholder="nama@del.ac.id"
                           value="{{ old('email', $savedEmail) }}"
                           required
                           autofocus>
                    @if ($savedEmail && !old('email'))
                        <div style="font-size: 0.75rem; color: var(--sipus-primary); margin-top: 0.25rem;">
                            ✓ Email otomatis dimuat dari Cookie terenkripsi (<code>del_last_user_email</code>)
                        </div>
                    @endif
                    @error('email')
                        <div style="font-size: 0.775rem; color: var(--sipus-danger); margin-top: 0.25rem;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Password --}}
                <div style="margin-bottom: 1.25rem;">
                    <label for="password" class="sipus-filter-label" style="font-weight: 600; margin-bottom: 0.35rem;">
                        Kata Sandi <span style="color: var(--sipus-danger);">*</span>
                    </label>
                    <input type="password"
                           name="password"
                           id="password"
                           class="sipus-input"
                           placeholder="Masukkan kata sandi..."
                           required>
                    @error('password')
                        <div style="font-size: 0.775rem; color: var(--sipus-danger); margin-top: 0.25rem;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem;">
                    <label style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; color: var(--sipus-text); cursor: pointer;">
                        <input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                        <span>Ingat sesi saya</span>
                    </label>
                    <span style="font-size: 0.775rem; color: var(--sipus-text-muted);">
                        Sesi terlindungi HttpOnly
                    </span>
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="sipus-btn sipus-btn-primary w-full" style="padding: 0.75rem 1rem; font-size: 1rem; justify-content: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="18" height="18">
                        <path fill-rule="evenodd" d="M3 4.25A2.25 2.25 0 015.25 2h5.5A2.25 2.25 0 0113 4.25v2a.75.75 0 01-1.5 0v-2a.75.75 0 00-.75-.75h-5.5a.75.75 0 00-.75.75v11.5c0 .414.336.75.75.75h5.5a.75.75 0 00.75-.75v-2a.75.75 0 011.5 0v2A2.25 2.25 0 0110.75 18h-5.5A2.25 2.25 0 013 15.75V4.25z" clip-rule="evenodd" />
                        <path fill-rule="evenodd" d="M19 10a.75.75 0 00-.75-.75H8.704l1.048-.943a.75.75 0 10-1.004-1.114l-2.5 2.25a.75.75 0 000 1.114l2.5 2.25a.75.75 0 101.004-1.114l-1.048-.943h9.546A.75.75 0 0019 10z" clip-rule="evenodd" />
                    </svg>
                    Masuk ke Sistem
                </button>
            </form>

            {{-- Informasi Kredensial Uji Praktikum --}}
            <div style="margin-top: 1.75rem; background: #F8FAFC; border: 1px dashed #CBD5E1; border-radius: 8px; padding: 1rem;">
                <div style="font-size: 0.775rem; font-weight: 700; color: var(--sipus-primary-dark); margin-bottom: 0.35rem; display: flex; align-items: center; gap: 0.35rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="14" height="14">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" />
                    </svg>
                    Akun Pustakawan Uji (Sesuai Modul Praktikum)
                </div>
                <div style="font-size: 0.8rem; color: var(--sipus-text); line-height: 1.5;">
                    <div>Email: <strong style="font-family: monospace;">pustakawan@del.ac.id</strong></div>
                    <div>Password: <strong style="font-family: monospace;">password123</strong></div>
                </div>
            </div>
        </div>
    </div>

</x-layout>
