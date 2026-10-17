<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'SIPUS-Del' }} — Perpustakaan Institut Teknologi Del</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="sipus-body">

    {{-- ============================================================ --}}
    {{-- TOP UTILITY BAR (Academic Portal Style) --}}
    {{-- ============================================================ --}}
    <div class="sipus-topbar">
        <div class="sipus-topbar-inner">
            <div class="sipus-topbar-left">
                <span class="sipus-topbar-item">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="14" height="14">
                        <path fill-rule="evenodd" d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 103 9c0 3.492 1.698 5.988 3.355 7.588a13.08 13.08 0 003.031 2.198l.018.008.006.003.002.001.001.001zM10 12a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                    </svg>
                    Gd. Perpustakaan & Laboratorium Terpadu, Institut Teknologi Del
                </span>
                <span class="sipus-topbar-item">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="14" height="14">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z" clip-rule="evenodd" />
                    </svg>
                    Senin – Jumat: 08.00 – 17.00 WIB
                </span>
            </div>
            <div class="sipus-topbar-right">
                <a href="{{ route('turnitin.index') }}" class="sipus-topbar-item">
                    Layanan Cek Turnitin Del
                </a>
                <span style="opacity: 0.4;">|</span>
                <a href="{{ route('layanan.bantuan') }}" class="sipus-topbar-item">
                    Bantuan Katalog
                </a>
            </div>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- MAIN HEADER (3 Balanced Sections) --}}
    {{-- ============================================================ --}}
    <header class="sipus-header">
        <div class="sipus-header-container">
            {{-- A. Logo di sebelah kiri --}}
            <a href="{{ route('dashboard') }}" class="sipus-brand">
                <div class="sipus-brand-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="22" height="22">
                        <path d="M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 20.636A8.214 8.214 0 0118 18.75c.966 0 1.89.166 2.75.47a.75.75 0 001-.708V4.262a.75.75 0 00-.5-.707A9.735 9.735 0 0018 3a9.707 9.707 0 00-5.25 1.533v16.103z" />
                    </svg>
                </div>
                <div class="sipus-brand-text">
                    <span class="sipus-brand-name">SIPUS-Del</span>
                    <span class="sipus-brand-sub">Sistem Informasi Perpustakaan Institut Teknologi Del</span>
                </div>
            </a>

            {{-- B. Navigasi tepat di tengah --}}
            <nav class="sipus-nav-center" aria-label="Navigasi Utama">
                <ul class="sipus-nav-menu">
                    <li>
                        <a href="{{ route('dashboard') }}"
                           class="sipus-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('katalog') }}"
                           class="sipus-nav-link {{ (request()->routeIs('katalog') || (request()->routeIs('buku.*') && request('view') != 'manage')) ? 'active' : '' }}">
                            Katalog Buku
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('kategori.index') }}"
                           class="sipus-nav-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                            Kategori
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('peminjaman.index') }}"
                           class="sipus-nav-link {{ request()->routeIs('peminjaman.*') ? 'active' : '' }}">
                            Sirkulasi
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('layanan.index') }}"
                           class="sipus-nav-link {{ request()->routeIs('layanan.*') || request()->routeIs('turnitin.*') ? 'active' : '' }}">
                            Layanan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tentang') }}"
                           class="sipus-nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}">
                            Tentang Kami
                        </a>
                    </li>
                </ul>
            </nav>

            {{-- C. Area Pengguna di sebelah kanan --}}
            <div class="sipus-header-right">
                @auth
                    <div style="display: flex; align-items: center; gap: 0.65rem; flex-wrap: wrap;">
                        <a href="{{ route('buku.index', ['view' => 'manage']) }}"
                           class="sipus-btn-nav-login"
                           title="Kelola Data Buku & Kategori">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="16" height="16">
                                <path fill-rule="evenodd" d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" clip-rule="evenodd" />
                            </svg>
                            Kelola
                        </a>
                        <div style="font-size: 0.775rem; color: var(--sipus-primary-dark); font-weight: 700; display: flex; align-items: center; gap: 0.35rem; padding: 0.35rem 0.6rem; background: var(--sipus-primary-pale); border-radius: 6px;">
                            <span style="width: 7px; height: 7px; border-radius: 50%; background: var(--sipus-success);"></span>
                            {{ Str::limit(Auth::user()->name, 14) }}
                        </div>
                        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" class="sipus-btn-sm sipus-btn-sm-danger" title="Keluar dari sesi pustakawan" style="padding: 0.4rem 0.65rem; font-size: 0.775rem; cursor: pointer;">
                                Logout
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                       class="sipus-btn-nav-login"
                       title="Login Pustakawan">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="16" height="16">
                            <path fill-rule="evenodd" d="M3 4.25A2.25 2.25 0 015.25 2h5.5A2.25 2.25 0 0113 4.25v2a.75.75 0 01-1.5 0v-2a.75.75 0 00-.75-.75h-5.5a.75.75 0 00-.75.75v11.5c0 .414.336.75.75.75h5.5a.75.75 0 00.75-.75v-2a.75.75 0 011.5 0v2A2.25 2.25 0 0110.75 18h-5.5A2.25 2.25 0 013 15.75V4.25z" clip-rule="evenodd" />
                            <path fill-rule="evenodd" d="M19 10a.75.75 0 00-.75-.75H8.704l1.048-.943a.75.75 0 10-1.004-1.114l-2.5 2.25a.75.75 0 000 1.114l2.5 2.25a.75.75 0 101.004-1.114l-1.048-.943h9.546A.75.75 0 0019 10z" clip-rule="evenodd" />
                        </svg>
                        Login Pustakawan
                    </a>
                @endauth
            </div>

            {{-- D. Mobile Hamburger Toggle --}}
            <button class="sipus-mobile-toggle" id="navToggle" aria-label="Buka Menu Navigasi">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="26" height="26">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>

        {{-- Mobile Menu Drawer --}}
        <div class="sipus-mobile-menu" id="mobileMenu">
            <ul class="sipus-mobile-nav-list">
                <li><a href="{{ route('dashboard') }}" class="sipus-mobile-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Beranda</a></li>
                <li><a href="{{ route('katalog') }}" class="sipus-mobile-nav-link {{ request()->routeIs('katalog') ? 'active' : '' }}">Katalog Buku</a></li>
                <li><a href="{{ route('kategori.index') }}" class="sipus-mobile-nav-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}">Kategori</a></li>
                <li><a href="{{ route('peminjaman.index') }}" class="sipus-mobile-nav-link {{ request()->routeIs('peminjaman.*') ? 'active' : '' }}">Sirkulasi Peminjaman</a></li>
                <li><a href="{{ route('layanan.index') }}" class="sipus-mobile-nav-link {{ request()->routeIs('layanan.*') ? 'active' : '' }}">Layanan Perpustakaan</a></li>
                <li><a href="{{ route('turnitin.index') }}" class="sipus-mobile-nav-link {{ request()->routeIs('turnitin.*') ? 'active' : '' }}">Pengajuan Cek Turnitin</a></li>
                <li><a href="{{ route('tentang') }}" class="sipus-mobile-nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}">Tentang Kami</a></li>
                @auth
                    <li><a href="{{ route('buku.index', ['view' => 'manage']) }}" class="sipus-mobile-nav-link">Kelola Koleksi (Admin)</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="padding: 0.5rem 1rem;">
                            @csrf
                            <button type="submit" class="sipus-btn-sm sipus-btn-sm-danger w-full">Logout ({{ Auth::user()->name }})</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}" class="sipus-mobile-nav-link">Login Pustakawan</a></li>
                @endauth
            </ul>
        </div>
    </header>

    {{-- ============================================================ --}}
    {{-- MAIN CONTENT AREA --}}
    {{-- ============================================================ --}}
    <main class="sipus-main">
        {{-- Flash Alerts --}}
        @if (session('success') || session('error'))
            <div class="sipus-container" style="padding-top: 1.5rem;">
                @if (session('success'))
                    <div class="sipus-alert sipus-alert-success" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="20" height="20">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                        </svg>
                        <div>{{ session('success') }}</div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="sipus-alert sipus-alert-error" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="20" height="20">
                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z" clip-rule="evenodd" />
                        </svg>
                        <div>{{ session('error') }}</div>
                    </div>
                @endif
            </div>
        @endif

        {{-- Page Slot --}}
        {{ $slot }}
    </main>

    {{-- ============================================================ --}}
    {{-- FOOTER --}}
    {{-- ============================================================ --}}
    <footer class="sipus-footer">
        <div class="sipus-container">
            <div class="sipus-footer-grid">
                <div>
                    <h3 class="sipus-footer-brand-title">SIPUS-Del</h3>
                    <p class="sipus-footer-brand-desc">
                        Sistem Informasi Perpustakaan Institut Teknologi Del memfasilitasi sivitas akademika dalam mencari koleksi buku, skripsi, serta mengetahui lokasi lantai dan nomor rak secara akurat dan transparan.
                    </p>
                    <p style="font-size: 0.8125rem; color: #94A3B8;">
                        <strong>Institut Teknologi Del</strong><br>
                        Jl. Sisingamangaraja, Sitoluama, Laguboti, Toba, Sumatera Utara
                    </p>
                </div>

                <div>
                    <h4 class="sipus-footer-col-title">Navigasi</h4>
                    <ul class="sipus-footer-links">
                        <li><a href="{{ route('dashboard') }}">Beranda</a></li>
                        <li><a href="{{ route('katalog') }}">Katalog Buku</a></li>
                        <li><a href="{{ route('kategori.index') }}">Kategori Koleksi</a></li>
                        <li><a href="{{ route('layanan.index') }}">Layanan Perpustakaan</a></li>
                        <li><a href="{{ route('tentang') }}">Tentang Kami</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="sipus-footer-col-title">Layanan</h4>
                    <ul class="sipus-footer-links">
                        <li><a href="{{ route('turnitin.index') }}">Pengajuan Cek Turnitin</a></li>
                        <li><a href="{{ route('katalog') }}">Pencarian Katalog</a></li>
                        <li><a href="{{ route('katalog', ['lantai' => 1]) }}">Koleksi Lantai 1 (Buku Teks)</a></li>
                        <li><a href="{{ route('katalog', ['lantai' => 2]) }}">Koleksi Lantai 2 (Skripsi)</a></li>
                        <li><a href="{{ route('layanan.bantuan') }}">Bantuan & Tata Tertib</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="sipus-footer-col-title">Zona Lantai Perpustakaan</h4>
                    <p style="font-size: 0.8125rem; color: #94A3B8; line-height: 1.6; margin-bottom: 0.75rem;">
                        <strong style="color: #ffffff;">Lantai 1:</strong> Buku Pelajaran & Referensi Utama Kuliah.<br>
                        <strong style="color: #ffffff;">Lantai 2:</strong> Koleksi Skripsi & Tugas Akhir Mahasiswa.
                    </p>
                    <div style="background: rgba(255,255,255,0.06); padding: 0.75rem; border-radius: 6px; font-size: 0.775rem; color: #CBD5E1;">
                        Terintegrasi dengan basis data MySQL Institut Teknologi Del.
                    </div>
                </div>
            </div>

            <div class="sipus-footer-bottom">
                <div>
                    &copy; {{ date('Y') }} <strong>SIPUS-Del</strong> — Institut Teknologi Del. Hak cipta dilindungi.
                </div>
                <div>
                    Sistem Informasi Perpustakaan Berbasis Laravel &amp; MySQL
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
