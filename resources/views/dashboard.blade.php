<x-layout title="Beranda">

    {{-- ============================================================ --}}
    {{-- A. HERO SECTION --}}
    {{-- ============================================================ --}}
    <section class="sipus-hero">
        <div class="sipus-container">
            <div class="sipus-hero-inner">
                <div class="sipus-hero-badge">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="14" height="14">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-11.25a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z" clip-rule="evenodd" />
                    </svg>
                    Perpustakaan Akademik Institut Teknologi Del
                </div>

                <h1 class="sipus-hero-title">
                    Temukan Pengetahuan, Bangun Masa Depan
                </h1>

                <p class="sipus-hero-desc">
                    Jelajahi koleksi buku dan manfaatkan layanan perpustakaan Institut Teknologi Del untuk mendukung kegiatan belajar, penelitian, dan pengembangan pengetahuan.
                </p>

                <div class="sipus-hero-actions">
                    <a href="{{ route('katalog') }}" class="sipus-btn sipus-btn-white">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="16" height="16">
                            <path d="M10.75 2.75a.75.75 0 00-1.5 0v8.614L6.295 8.235a.75.75 0 10-1.09 1.03l4.25 4.5a.75.75 0 001.09 0l4.25-4.5a.75.75 0 00-1.09-1.03l-2.955 3.129V2.75z" />
                            <path d="M3.5 12.75a.75.75 0 00-1.5 0v2.5A2.75 2.75 0 004.75 18h10.5A2.75 2.75 0 0018 15.25v-2.5a.75.75 0 00-1.5 0v2.5c0 .69-.56 1.25-1.25 1.25H4.75c-.69 0-1.25-.56-1.25-1.25v-2.5z" />
                        </svg>
                        Jelajahi Katalog
                    </a>
                    <a href="{{ route('layanan.index') }}" class="sipus-btn sipus-btn-outline-white">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="16" height="16">
                            <path fill-rule="evenodd" d="M3 4.25A2.25 2.25 0 015.25 2h5.5A2.25 2.25 0 0113 4.25v2a.75.75 0 01-1.5 0v-2a.75.75 0 00-.75-.75h-5.5a.75.75 0 00-.75.75v11.5c0 .414.336.75.75.75h5.5a.75.75 0 00.75-.75v-2a.75.75 0 011.5 0v2A2.25 2.25 0 0110.75 18h-5.5A2.25 2.25 0 013 15.75V4.25z" clip-rule="evenodd" />
                            <path fill-rule="evenodd" d="M19 10a.75.75 0 00-.75-.75H8.704l1.048-.943a.75.75 0 10-1.004-1.114l-2.5 2.25a.75.75 0 000 1.114l2.5 2.25a.75.75 0 101.004-1.114l-1.048-.943h9.546A.75.75 0 0019 10z" clip-rule="evenodd" />
                        </svg>
                        Lihat Layanan
                    </a>
                </div>

                {{-- B. Kolom Pencarian Buku Cepat --}}
                <form action="{{ route('katalog') }}" method="GET" class="sipus-search-box">
                    <div class="sipus-search-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="20" height="20">
                            <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text"
                           name="q"
                           class="sipus-search-input"
                           placeholder="Cari judul buku, penulis, ISBN, atau kategori..."
                           aria-label="Cari buku perpustakaan">
                    <button type="submit" class="sipus-search-btn">
                        Cari Buku
                    </button>
                </form>
            </div>
        </div>
    </section>

    {{-- ============================================================ --}}
    {{-- C. STATISTIK KOLEKSI (Berdasarkan Database MySQL Asli) --}}
    {{-- ============================================================ --}}
    <div class="sipus-container">
        <div class="sipus-stats-band">
            <div class="sipus-stats-card-grid">
                <div class="sipus-stat-item">
                    <div class="sipus-stat-icon-wrapper sipus-stat-icon-purple">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="26" height="26">
                            <path d="M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 20.636A8.214 8.214 0 0118 18.75c.966 0 1.89.166 2.75.47a.75.75 0 001-.708V4.262a.75.75 0 00-.5-.707A9.735 9.735 0 0018 3a9.707 9.707 0 00-5.25 1.533v16.103z" />
                        </svg>
                    </div>
                    <div>
                        <div class="sipus-stat-number">{{ number_format($totalBuku) }}</div>
                        <div class="sipus-stat-title">Total Judul Koleksi</div>
                    </div>
                </div>

                <div class="sipus-stat-item">
                    <div class="sipus-stat-icon-wrapper sipus-stat-icon-green">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="26" height="26">
                            <path d="M3.375 3C2.339 3 1.5 3.84 1.5 4.875v.75c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875v-.75C22.5 3.839 21.66 3 20.625 3H3.375z" />
                            <path fill-rule="evenodd" d="M3.087 9l.54 9.176A3 3 0 006.62 21h10.757a3 3 0 002.995-2.824L20.913 9H3.087zm6.163 3.75A.75.75 0 0110 12h4a.75.75 0 010 1.5h-4a.75.75 0 01-.75-.75z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <div class="sipus-stat-number">{{ number_format($totalStok) }}</div>
                        <div class="sipus-stat-title">Stok Eksemplar Tersedia</div>
                    </div>
                </div>

                <div class="sipus-stat-item">
                    <div class="sipus-stat-icon-wrapper sipus-stat-icon-amber">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="26" height="26">
                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <div class="sipus-stat-number">{{ number_format($sedangDipinjam) }}</div>
                        <div class="sipus-stat-title">Buku Sedang Dipinjam</div>
                    </div>
                </div>

                <div class="sipus-stat-item">
                    <div class="sipus-stat-icon-wrapper sipus-stat-icon-blue">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="26" height="26">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <div class="sipus-stat-number">{{ number_format($sudahKembali) }}</div>
                        <div class="sipus-stat-title">Total Dikembalikan</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- 5. LAYANAN PERPUSTAKAAN (4 Kartu Layanan Wajib) --}}
    {{-- ============================================================ --}}
    <div class="sipus-container">
        <section class="sipus-section">
            <div class="sipus-section-header">
                <div>
                    <div class="sipus-section-tag">Fasilitas &amp; Aksesibilitas</div>
                    <h2 class="sipus-section-title">Layanan Perpustakaan</h2>
                    <p class="sipus-section-subtitle">Akses layanan terpadu untuk mendukung tugas akhir, penelitian, dan literasi mahasiswa Del</p>
                </div>
                <a href="{{ route('layanan.index') }}" class="sipus-section-more">
                    Lihat Semua Layanan →
                </a>
            </div>

            <div class="sipus-services-grid">
                {{-- A. Cek Turnitin --}}
                <div class="sipus-service-card">
                    <div class="sipus-service-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="28" height="28">
                            <path fill-rule="evenodd" d="M5.625 1.5H9a3.75 3.75 0 013.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 013.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 01-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875zm6.905 9.97a.75.75 0 00-1.06 0l-3 3a.75.75 0 101.06 1.06l1.72-1.72V18a.75.75 0 001.5 0v-4.19l1.72 1.72a.75.75 0 101.06-1.06l-3-3z" clip-rule="evenodd" />
                            <path d="M14.25 5.25a5.23 5.23 0 00-1.279-3.434 9.768 9.768 0 016.963 6.963A5.23 5.23 0 0016.5 7.5h-1.875a.375.375 0 01-.375-.375V5.25z" />
                        </svg>
                    </div>
                    <h3 class="sipus-service-title">Cek Turnitin</h3>
                    <p class="sipus-service-desc">
                        Ajukan pemeriksaan tingkat kemiripan dokumen akademik untuk membantu mengevaluasi orisinalitas karya tulis.
                    </p>
                    <a href="{{ route('turnitin.index') }}" class="sipus-service-btn">
                        Ajukan Pemeriksaan →
                    </a>
                </div>

                {{-- B. Pencarian Katalog Buku --}}
                <div class="sipus-service-card">
                    <div class="sipus-service-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="28" height="28">
                            <path d="M8.25 10.875a2.625 2.625 0 115.25 0 2.625 2.625 0 01-5.25 0z" />
                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.125 4.5a4.125 4.125 0 102.338 7.524l2.007 2.006a.75.75 0 101.06-1.06l-2.006-2.007A4.125 4.125 0 0010.875 6.75z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="sipus-service-title">Pencarian Katalog Buku</h3>
                    <p class="sipus-service-desc">
                        Temukan referensi berdasarkan judul, penulis, ISBN, atau kategori buku secara mudah.
                    </p>
                    <a href="{{ route('katalog') }}" class="sipus-service-btn">
                        Cari Buku →
                    </a>
                </div>

                {{-- C. Informasi Ketersediaan Buku --}}
                <div class="sipus-service-card">
                    <div class="sipus-service-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="28" height="28">
                            <path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="sipus-service-title">Informasi Ketersediaan Buku</h3>
                    <p class="sipus-service-desc">
                        Periksa koleksi, stok, serta lokasi lantai dan rak buku yang ingin ditemukan sebelum datang ke gedung perpustakaan.
                    </p>
                    <a href="{{ route('katalog') }}" class="sipus-service-btn">
                        Lihat Koleksi →
                    </a>
                </div>

                {{-- D. Bantuan Perpustakaan --}}
                <div class="sipus-service-card">
                    <div class="sipus-service-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="28" height="28">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm11.378-3.917c-.076-.656-.582-1.161-1.24-1.238a41.488 41.488 0 00-5.276 0c-.658.077-1.164.582-1.24 1.238a41.516 41.516 0 000 7.834c.076.656.582 1.161 1.24 1.238a41.488 41.488 0 005.276 0c.658-.077 1.164-.582 1.24-1.238a41.516 41.516 0 000-7.834zM9.75 9.75a.75.75 0 000 1.5h.008a.75.75 0 000-1.5H9.75zm0 3a.75.75 0 000 1.5h4.5a.75.75 0 000-1.5h-4.5z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="sipus-service-title">Bantuan Perpustakaan</h3>
                    <p class="sipus-service-desc">
                        Dapatkan informasi mengenai penggunaan katalog, peminjaman, aturan lantai koleksi, dan kontak staf perpustakaan.
                    </p>
                    <a href="{{ route('layanan.bantuan') }}" class="sipus-service-btn">
                        Lihat Bantuan →
                    </a>
                </div>
            </div>
        </section>
    </div>

    {{-- ============================================================ --}}
    {{-- D. KATEGORI BUKU --}}
    {{-- ============================================================ --}}
    <div class="sipus-container">
        <section class="sipus-section">
            <div class="sipus-section-header">
                <div>
                    <div class="sipus-section-tag">Klasifikasi Keilmuan</div>
                    <h2 class="sipus-section-title">Kategori Buku</h2>
                    <p class="sipus-section-subtitle">Temukan buku berdasarkan bidang keilmuan yang diajarkan di Institut Teknologi Del</p>
                </div>
                <a href="{{ route('kategori.index') }}" class="sipus-section-more">
                    Lihat Semua Kategori →
                </a>
            </div>

            <div class="sipus-category-grid">
                @forelse ($kategoris as $kategori)
                    <a href="{{ route('katalog', ['kategori' => $kategori->id]) }}" class="sipus-category-card">
                        <div class="sipus-category-icon">
                            <span style="font-weight: 800; font-size: 0.8rem;">{{ $kategori->kode_kategori }}</span>
                        </div>
                        <div>
                            <div class="sipus-category-name">{{ $kategori->nama_kategori }}</div>
                            <div class="sipus-category-count">{{ $kategori->bukus_count }} Koleksi Terdaftar</div>
                        </div>
                    </a>
                @empty
                    <div class="sipus-empty-state" style="grid-column: 1 / -1;">
                        <p>Kategori belum tersedia di database.</p>
                    </div>
                @endforelse
            </div>
        </section>
    </div>

    {{-- ============================================================ --}}
    {{-- E. BUKU TERBARU & LOKASI LANTAI/RAK --}}
    {{-- ============================================================ --}}
    <div class="sipus-container">
        <section class="sipus-section">
            <div class="sipus-section-header">
                <div>
                    <div class="sipus-section-tag">Koleksi Terkini</div>
                    <h2 class="sipus-section-title">Buku Pilihan &amp; Terbaru</h2>
                    <p class="sipus-section-subtitle">Koleksi buku teks dan skripsi lengkap dengan informasi lantai dan nomor rak</p>
                </div>
                <a href="{{ route('katalog') }}" class="sipus-section-more">
                    Lihat Semua Buku di Katalog →
                </a>
            </div>

            <div class="sipus-book-grid">
                @forelse ($bukuTerbaru as $buku)
                    <div class="sipus-book-card">
                        <div class="sipus-book-header">
                            <span class="sipus-book-collection-badge {{ $buku->jenis_koleksi === 'Skripsi' ? 'sipus-badge-skripsi' : 'sipus-badge-pelajaran' }}">
                                {{ $buku->jenis_koleksi ?? 'Buku Pelajaran' }}
                            </span>

                            @if ($buku->kategori)
                                <span style="font-size: 0.725rem; font-weight: 700; color: var(--sipus-primary); background: var(--sipus-primary-pale); padding: 0.2rem 0.5rem; border-radius: 4px;">
                                    {{ $buku->kategori->kode_kategori }}
                                </span>
                            @endif
                        </div>

                        <h3 class="sipus-book-title">
                            <a href="{{ route('buku.show', $buku) }}">{{ $buku->judul }}</a>
                        </h3>
                        <div class="sipus-book-author">Oleh {{ $buku->penulis }} ({{ $buku->tahun_terbit }})</div>

                        {{-- Lokasi Lantai & Rak (Fitur Kunci) --}}
                        <div class="sipus-location-box">
                            <div class="sipus-location-item" title="Lantai Penempatan">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="16" height="16">
                                    <path fill-rule="evenodd" d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 103 9c0 3.492 1.698 5.988 3.355 7.588a13.08 13.08 0 003.031 2.198l.018.008.006.003.002.001.001.001zM10 12a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                                </svg>
                                <span>{{ $buku->lantai ? 'Lantai ' . $buku->lantai : 'Lokasi belum ditentukan' }}</span>
                            </div>
                            <div class="sipus-location-divider"></div>
                            <div class="sipus-location-item" title="Nomor / Kode Rak">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="16" height="16">
                                    <path fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z" clip-rule="evenodd" />
                                </svg>
                                <span>{{ $buku->kode_rak ? 'Rak ' . $buku->kode_rak : 'Rak -' }}</span>
                            </div>
                        </div>

                        <div class="sipus-book-footer">
                            <div style="display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;">
                                @if ($buku->stok > 0)
                                    <span class="sipus-status-pill sipus-status-available">
                                        <span class="sipus-status-dot"></span>
                                        Tersedia ({{ $buku->stok }})
                                    </span>
                                @else
                                    <span class="sipus-status-pill sipus-status-empty">
                                        <span class="sipus-status-dot"></span>
                                        Tidak tersedia
                                    </span>
                                @endif
                                <span style="font-size: 0.725rem; color: var(--sipus-primary); background: var(--sipus-primary-pale); padding: 0.15rem 0.45rem; border-radius: 4px; font-weight: 600;">
                                    {{ $buku->peminjamans_count }}x dipinjam
                                </span>
                            </div>
                            <a href="{{ route('buku.show', $buku) }}" style="color: var(--sipus-primary); font-weight: 600; text-decoration: none;">
                                Detail &rarr;
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="sipus-empty-state" style="grid-column: 1 / -1;">
                        <p>Belum ada buku di database SIPUS-Del.</p>
                    </div>
                @endforelse
            </div>

            <div style="text-align: center; margin-top: 2.5rem;">
                <a href="{{ route('katalog') }}" class="sipus-btn sipus-btn-primary">
                    Lihat Semua Koleksi Buku &rarr;
                </a>
            </div>
        </section>
    </div>

</x-layout>
