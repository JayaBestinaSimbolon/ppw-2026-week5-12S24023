<x-layout title="{{ $buku->judul }}">

    <div class="sipus-container sipus-content-wrap">
        {{-- Breadcrumb & Navigasi Kembali --}}
        <div style="margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem;">
            <div style="font-size: 0.85rem; color: var(--sipus-text-muted);">
                <a href="{{ route('dashboard') }}" style="color: inherit; text-decoration: none;">Beranda</a> &rsaquo;
                <a href="{{ route('katalog') }}" style="color: inherit; text-decoration: none;">Katalog</a> &rsaquo;
                <span style="color: var(--sipus-primary); font-weight: 600;">Detail Buku</span>
            </div>
            <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('katalog') }}" class="sipus-btn sipus-btn-ghost">
                &larr; Kembali ke Katalog
            </a>
        </div>

        <div class="sipus-detail-layout">
            {{-- Main Column --}}
            <div class="sipus-card sipus-detail-main">
                <div class="sipus-detail-header">
                    <div class="sipus-detail-book-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="36" height="36">
                            <path d="M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 20.636A8.214 8.214 0 0118 18.75c.966 0 1.89.166 2.75.47a.75.75 0 001-.708V4.262a.75.75 0 00-.5-.707A9.735 9.735 0 0018 3a9.707 9.707 0 00-5.25 1.533v16.103z" />
                        </svg>
                    </div>
                    <div>
                        <div style="margin-bottom: 0.5rem; display: flex; gap: 0.5rem; flex-wrap: wrap;">
                            <span class="sipus-book-collection-badge {{ $buku->jenis_koleksi === 'Skripsi' ? 'sipus-badge-skripsi' : 'sipus-badge-pelajaran' }}">
                                {{ $buku->jenis_koleksi ?? 'Buku Pelajaran' }}
                            </span>
                            @if ($buku->kategori)
                                <span class="sipus-badge sipus-badge-purple">
                                    {{ $buku->kategori->nama_kategori }}
                                </span>
                            @endif
                        </div>

                        <h1 class="sipus-detail-title">{{ $buku->judul }}</h1>
                        <p class="sipus-detail-penulis">Penulis / Pengarang: <strong>{{ $buku->penulis }}</strong></p>
                    </div>
                </div>

                {{-- ============================================================ --}}
                {{-- 7.D. BAGIAN DETAIL LOKASI BUKU DI PERPUSTAKAAN (Wajib & Jelas) --}}
                {{-- ============================================================ --}}
                <div class="sipus-location-banner">
                    <h3 class="sipus-location-banner-title">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="22" height="22">
                            <path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                        </svg>
                        Lokasi Buku di Perpustakaan
                    </h3>

                    <div class="sipus-location-banner-grid">
                        <div class="sipus-location-banner-item">
                            <div class="sipus-location-banner-label">Lokasi Lantai</div>
                            <div class="sipus-location-banner-value">
                                {{ $buku->lantai ? 'Lantai ' . $buku->lantai : 'Lokasi belum ditentukan' }}
                            </div>
                        </div>

                        <div class="sipus-location-banner-item">
                            <div class="sipus-location-banner-label">Jenis Koleksi</div>
                            <div class="sipus-location-banner-value">
                                {{ $buku->jenis_koleksi ?? 'Buku Pelajaran' }}
                            </div>
                        </div>

                        <div class="sipus-location-banner-item">
                            <div class="sipus-location-banner-label">Nomor / Kode Rak</div>
                            <div class="sipus-location-banner-value">
                                {{ $buku->kode_rak ? $buku->kode_rak : 'Belum Ditentukan' }}
                            </div>
                        </div>

                        <div class="sipus-location-banner-item">
                            <div class="sipus-location-banner-label">Status Ketersediaan</div>
                            <div class="sipus-location-banner-value" style="color: {{ $buku->stok > 0 ? 'var(--sipus-success)' : 'var(--sipus-danger)' }};">
                                {{ $buku->stok > 0 ? 'Tersedia (' . $buku->stok . ' eks)' : 'Tidak Tersedia' }}
                            </div>
                        </div>
                    </div>

                    {{-- Petunjuk Navigasi Fisik untuk Pengunjung --}}
                    @if ($buku->lantai && $buku->kode_rak)
                        <div class="sipus-location-instruction">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="18" height="18" style="flex-shrink: 0;">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" />
                            </svg>
                            <span>
                                Petunjuk Mahasiswa: Silakan menuju <strong>Lantai {{ $buku->lantai }}</strong> perpustakaan Del dan cari rak nomor <strong>{{ $buku->kode_rak }}</strong>.
                            </span>
                        </div>
                    @else
                        <div class="sipus-location-instruction" style="background: #FFFBEB; border-color: #F59E0B; color: #92400E;">
                            <span>Lokasi rak fisik untuk buku ini sedang dalam proses penataan oleh pustakawan Del.</span>
                        </div>
                    @endif
                </div>

                {{-- Informasi Metadata Buku --}}
                <div class="sipus-info-grid">
                    <div class="sipus-info-item">
                        <div class="sipus-info-label">ISBN / Identifikasi</div>
                        <div class="sipus-info-value sipus-mono">{{ $buku->isbn }}</div>
                    </div>
                    <div class="sipus-info-item">
                        <div class="sipus-info-label">Penerbit / Institusi</div>
                        <div class="sipus-info-value">{{ $buku->penerbit }}</div>
                    </div>
                    <div class="sipus-info-item">
                        <div class="sipus-info-label">Tahun Terbit</div>
                        <div class="sipus-info-value">{{ $buku->tahun_terbit }}</div>
                    </div>
                    <div class="sipus-info-item">
                        <div class="sipus-info-label">Kategori Subjek</div>
                        <div class="sipus-info-value">{{ $buku->kategori?->nama_kategori ?? '—' }}</div>
                    </div>
                    <div class="sipus-info-item">
                        <div class="sipus-info-label">Stok Fisik</div>
                        <div class="sipus-info-value">{{ $buku->stok }} Eksemplar</div>
                    </div>
                    <div class="sipus-info-item">
                        <div class="sipus-info-label">Tanggal Masuk Database</div>
                        <div class="sipus-info-value">{{ $buku->created_at->format('d F Y') }}</div>
                    </div>
                </div>

                {{-- Sinopsis / Deskripsi --}}
                <div class="sipus-sinopsis">
                    <div class="sipus-sinopsis-title">Ringkasan / Sinopsis Koleksi</div>
                    <p class="sipus-sinopsis-text">
                        {{ $buku->sinopsis ?? 'Sinopsis atau ringkasan belum disediakan untuk koleksi ini.' }}
                    </p>
                </div>
            </div>

            {{-- Sidebar Tindakan & Buku Terkait --}}
            <div class="sipus-detail-sidebar">
                {{-- Card Transaksi Peminjaman (ACID & Concurrency Locking) --}}
                <div class="sipus-card" style="border-top: 4px solid var(--sipus-primary);">
                    <h4 class="sipus-sidebar-title" style="display: flex; justify-content: space-between; align-items: center;">
                        <span>Sirkulasi Peminjaman</span>
                        <span style="font-size: 0.75rem; font-weight: normal; color: var(--sipus-text-muted);">
                            {{ $buku->peminjamans()->count() }}x total dipinjam
                        </span>
                    </h4>

                    @auth
                        @if ($buku->stok > 0)
                            <form action="{{ route('peminjaman.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 0.75rem;">
                                @csrf
                                <input type="hidden" name="buku_id" value="{{ $buku->id }}">

                                <div>
                                    <label class="sipus-filter-label" for="show_nim">NIM Mahasiswa <span style="color: var(--sipus-danger);">*</span></label>
                                    <input type="text" name="nim_peminjam" id="show_nim" class="sipus-input" placeholder="Contoh: 12S24023" required value="{{ old('nim_peminjam') }}">
                                </div>

                                <div>
                                    <label class="sipus-filter-label" for="show_nama">Nama Mahasiswa <span style="color: var(--sipus-danger);">*</span></label>
                                    <input type="text" name="nama_peminjam" id="show_nama" class="sipus-input" placeholder="Nama mahasiswa..." required value="{{ old('nama_peminjam') }}">
                                </div>

                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;">
                                    <div>
                                        <label class="sipus-filter-label" for="show_pinjam">Tgl Pinjam</label>
                                        <input type="date" name="tanggal_pinjam" id="show_pinjam" class="sipus-input" style="padding: 0.4rem 0.5rem; font-size: 0.8rem;" value="{{ now()->toDateString() }}" required>
                                    </div>
                                    <div>
                                        <label class="sipus-filter-label" for="show_tempo">Jatuh Tempo</label>
                                        <input type="date" name="tanggal_jatuh_tempo" id="show_tempo" class="sipus-input" style="padding: 0.4rem 0.5rem; font-size: 0.8rem;" value="{{ now()->addDays(7)->toDateString() }}" required>
                                    </div>
                                </div>

                                <button type="submit" class="sipus-btn sipus-btn-primary w-full" style="margin-top: 0.25rem;">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="16" height="16">
                                        <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                    </svg>
                                    Proses Pinjam Buku Ini
                                </button>
                            </form>
                        @else
                            <div class="sipus-alert sipus-alert-error" style="font-size: 0.85rem; padding: 0.75rem;">
                                <strong>Stok Habis (0 eksemplar).</strong> Peminjaman buku ini dinonaktifkan secara otomatis.
                            </div>
                        @endif
                    @else
                        <div style="background: var(--sipus-surface-subtle); padding: 1rem; border-radius: 8px; text-align: center;">
                            <p style="font-size: 0.85rem; color: var(--sipus-text-muted); margin-bottom: 0.75rem;">
                                Transaksi peminjaman dan mutasi koleksi hanya dapat diproses oleh Pustakawan yang telah login.
                            </p>
                            <a href="{{ route('login') }}" class="sipus-btn sipus-btn-primary" style="font-size: 0.85rem; display: inline-block;">
                                Login Pustakawan
                            </a>
                        </div>
                    @endauth

                    @if ($buku->peminjamans()->where('status', 'dipinjam')->count() > 0)
                        <div style="margin-top: 1rem; border-top: 1px solid var(--sipus-border-subtle); padding-top: 0.75rem;">
                            <div style="font-size: 0.775rem; font-weight: 700; color: var(--sipus-text); margin-bottom: 0.5rem;">
                                Sedang Dipinjam ({{ $buku->peminjamans()->where('status', 'dipinjam')->count() }}):
                            </div>
                            @foreach ($buku->peminjamans()->where('status', 'dipinjam')->get() as $p)
                                <div style="font-size: 0.75rem; color: var(--sipus-text-muted); margin-bottom: 0.35rem; display: flex; justify-content: space-between; align-items: center;">
                                    <span>{{ $p->nim_peminjam }} ({{ Str::limit($p->nama_peminjam, 12) }})</span>
                                    @auth
                                        <form action="{{ route('peminjaman.kembali', $p->id) }}" method="POST" style="margin: 0;">
                                            @csrf
                                            <button type="submit" class="sipus-btn-sm sipus-btn-sm-warning" style="font-size: 0.7rem; padding: 0.15rem 0.4rem;">
                                                Kembali
                                            </button>
                                        </form>
                                    @endauth
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                @auth
                <div class="sipus-card">
                    <h4 class="sipus-sidebar-title">Kelola Koleksi</h4>
                    <div class="sipus-sidebar-actions">
                        <a href="{{ route('buku.edit', $buku) }}" class="sipus-btn sipus-btn-primary w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="16" height="16">
                                <path d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z" />
                                <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75 2.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z" />
                            </svg>
                            Edit Buku &amp; Lokasi Rak
                        </a>

                        <form action="{{ route('buku.destroy', $buku) }}" method="POST"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku \'{{ addslashes($buku->judul) }}\' dari katalog perpustakaan?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="sipus-btn sipus-btn-danger w-full">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="16" height="16">
                                    <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z" clip-rule="evenodd" />
                                </svg>
                                Hapus Buku
                            </button>
                        </form>
                    </div>
                </div>
                @endauth

                @if ($bukuTerkait->isNotEmpty())
                    <div class="sipus-card">
                        <h4 class="sipus-sidebar-title">Koleksi Terkait</h4>
                        <div style="display: flex; flex-direction: column; gap: 0.85rem;">
                            @foreach ($bukuTerkait as $terkait)
                                <div style="border-bottom: 1px solid var(--sipus-border-subtle); padding-bottom: 0.65rem;">
                                    <a href="{{ route('buku.show', $terkait) }}" style="font-weight: 600; color: var(--sipus-text); text-decoration: none; font-size: 0.875rem; line-height: 1.3; display: block; margin-bottom: 0.2rem;">
                                        {{ $terkait->judul }}
                                    </a>
                                    <div style="font-size: 0.775rem; color: var(--sipus-text-muted);">
                                        {{ $terkait->lantai ? 'Lt. ' . $terkait->lantai : '' }} {{ $terkait->kode_rak ? '&middot; Rak ' . $terkait->kode_rak : '' }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

</x-layout>
