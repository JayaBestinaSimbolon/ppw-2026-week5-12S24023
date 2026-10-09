<x-layout title="Dashboard">

    {{-- ============================================================ --}}
    {{-- PAGE HEADER --}}
    {{-- ============================================================ --}}
    <div class="sipus-page-header">
        <div>
            <h1 class="sipus-page-title">Dashboard</h1>
            <p class="sipus-page-subtitle">Selamat Datang di <strong>SIPUS-Del</strong></p>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- WELCOME SECTION --}}
    {{-- ============================================================ --}}
    <div class="sipus-welcome-card">
        <div class="sipus-welcome-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="32" height="32">
                <path d="M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 20.636A8.214 8.214 0 0118 18.75c.966 0 1.89.166 2.75.47a.75.75 0 001-.708V4.262a.75.75 0 00-.5-.707A9.735 9.735 0 0018 3a9.707 9.707 0 00-5.25 1.533v16.103z" />
            </svg>
        </div>
        <div class="sipus-welcome-content">
            <h2>Selamat Datang di SIPUS-Del</h2>
            <p>Kelola koleksi buku dan kategori perpustakaan Institut Teknologi Del dengan lebih mudah, cepat, dan terorganisir.</p>
            <div class="sipus-welcome-actions">
                <a href="{{ route('buku.create') }}" class="sipus-btn sipus-btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path fill-rule="evenodd" d="M12 3.75a.75.75 0 01.75.75v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5a.75.75 0 01.75-.75z" clip-rule="evenodd" /></svg>
                    Tambah Buku
                </a>
                <a href="{{ route('kategori.create') }}" class="sipus-btn sipus-btn-outline">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path fill-rule="evenodd" d="M12 3.75a.75.75 0 01.75.75v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5a.75.75 0 01.75-.75z" clip-rule="evenodd" /></svg>
                    Tambah Kategori
                </a>
            </div>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- STAT CARDS --}}
    {{-- ============================================================ --}}
    <div class="sipus-stats-grid">
        <div class="sipus-stat-card sipus-stat-purple">
            <div class="sipus-stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="24" height="24">
                    <path d="M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 20.636A8.214 8.214 0 0118 18.75c.966 0 1.89.166 2.75.47a.75.75 0 001-.708V4.262a.75.75 0 00-.5-.707A9.735 9.735 0 0018 3a9.707 9.707 0 00-5.25 1.533v16.103z" />
                </svg>
            </div>
            <div class="sipus-stat-content">
                <div class="sipus-stat-value">{{ number_format($totalBuku) }}</div>
                <div class="sipus-stat-label">Total Buku</div>
            </div>
        </div>

        <div class="sipus-stat-card sipus-stat-indigo">
            <div class="sipus-stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="24" height="24">
                    <path fill-rule="evenodd" d="M5.25 2.25a3 3 0 00-3 3v4.318a3 3 0 00.879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 005.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 00-2.121-.879H5.25zM6.375 7.5a1.125 1.125 0 100-2.25 1.125 1.125 0 000 2.25z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="sipus-stat-content">
                <div class="sipus-stat-value">{{ number_format($totalKategori) }}</div>
                <div class="sipus-stat-label">Total Kategori</div>
            </div>
        </div>

        <div class="sipus-stat-card sipus-stat-violet">
            <div class="sipus-stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="24" height="24">
                    <path d="M3.375 3C2.339 3 1.5 3.84 1.5 4.875v.75c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875v-.75C22.5 3.839 21.66 3 20.625 3H3.375z" />
                    <path fill-rule="evenodd" d="M3.087 9l.54 9.176A3 3 0 006.62 21h10.757a3 3 0 002.995-2.824L20.913 9H3.087zm6.163 3.75A.75.75 0 0110 12h4a.75.75 0 010 1.5h-4a.75.75 0 01-.75-.75z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="sipus-stat-content">
                <div class="sipus-stat-value">{{ number_format($totalStok) }}</div>
                <div class="sipus-stat-label">Total Stok Buku</div>
            </div>
        </div>

        <div class="sipus-stat-card sipus-stat-rose">
            <div class="sipus-stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="24" height="24">
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="sipus-stat-content">
                <div class="sipus-stat-value">{{ number_format($bukuStokHabis) }}</div>
                <div class="sipus-stat-label">Buku Stok Habis</div>
            </div>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- BUKU TERBARU --}}
    {{-- ============================================================ --}}
    <div class="sipus-card">
        <div class="sipus-card-header">
            <h3 class="sipus-card-title">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18">
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd" />
                </svg>
                Buku Terbaru
            </h3>
            <a href="{{ route('buku.index') }}" class="sipus-card-link">Lihat Semua →</a>
        </div>

        @forelse ($bukuTerbaru as $buku)
            <div class="sipus-list-item">
                <div class="sipus-list-item-info">
                    <div class="sipus-list-item-title">{{ $buku->judul }}</div>
                    <div class="sipus-list-item-meta">{{ $buku->penulis }} &middot; {{ $buku->penerbit }} &middot; {{ $buku->tahun_terbit }}</div>
                </div>
                <div class="sipus-list-item-badges">
                    @if ($buku->kategori)
                        <span class="sipus-badge sipus-badge-purple">{{ $buku->kategori->kode_kategori }}</span>
                    @endif
                    @if ($buku->stok === 0)
                        <span class="sipus-badge sipus-badge-red">Habis</span>
                    @elseif ($buku->stok <= 3)
                        <span class="sipus-badge sipus-badge-yellow">Terbatas</span>
                    @else
                        <span class="sipus-badge sipus-badge-green">Tersedia</span>
                    @endif
                </div>
            </div>
        @empty
            <div class="sipus-empty-state">
                <p>Belum ada koleksi buku. <a href="{{ route('buku.create') }}">Tambah sekarang</a></p>
            </div>
        @endforelse
    </div>

</x-layout>
