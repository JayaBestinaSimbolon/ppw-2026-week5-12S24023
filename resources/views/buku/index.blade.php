<x-layout title="Katalog Buku & Informasi Lokasi">

    <div class="sipus-container sipus-content-wrap">
        {{-- Header Halaman --}}
        <div class="sipus-page-header">
            <div>
                <h1 class="sipus-page-title">
                    {{ $viewMode === 'manage' ? 'Pengelolaan Koleksi Buku (Admin)' : 'Katalog Buku Perpustakaan' }}
                </h1>
                <p class="sipus-page-subtitle">
                    {{ $viewMode === 'manage' 
                        ? 'Kelola data buku, penempatan lantai 1 & 2, nomor rak, serta stok eksemplar' 
                        : 'Cari referensi, ketahui lantai penempatan dan kode rak sebelum berkunjung ke perpustakaan' }}
                </p>
            </div>
            <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
                @if ($viewMode === 'manage')
                    <a href="{{ route('katalog') }}" class="sipus-btn sipus-btn-outline">
                        Lihat Tampilan Katalog Mahasiswa
                    </a>
                    <a href="{{ route('buku.create') }}" class="sipus-btn sipus-btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="16" height="16">
                            <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                        </svg>
                        Tambah Buku Baru
                    </a>
                @else
                    <a href="{{ route('buku.index', ['view' => 'manage']) }}" class="sipus-btn sipus-btn-outline">
                        Mode Pengelolaan Admin
                    </a>
                @endif
            </div>
        </div>

        {{-- Kartu Statistik Koleksi Perpustakaan Menggunakan Fluent Query Builder (DB::table) --}}
        <div class="sipus-stats-band" style="margin-bottom: 2rem;">
            <div class="sipus-stats-card-grid">
                <div class="sipus-stat-item">
                    <div class="sipus-stat-icon-wrapper sipus-stat-icon-purple">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="26" height="26">
                            <path d="M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 20.636A8.214 8.214 0 0118 18.75c.966 0 1.89.166 2.75.47a.75.75 0 001-.708V4.262a.75.75 0 00-.5-.707A9.735 9.735 0 0018 3a9.707 9.707 0 00-5.25 1.533v16.103z" />
                        </svg>
                    </div>
                    <div>
                        <div class="sipus-stat-number">{{ number_format($stats['total_judul'] ?? 0) }}</div>
                        <div class="sipus-stat-title">Total Judul Buku</div>
                    </div>
                </div>

                <div class="sipus-stat-item">
                    <div class="sipus-stat-icon-wrapper sipus-stat-icon-blue">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="26" height="26">
                            <path d="M3.375 3C2.339 3 1.5 3.84 1.5 4.875v.75c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875v-.75C22.5 3.839 21.66 3 20.625 3H3.375z" />
                            <path fill-rule="evenodd" d="M3.087 9l.54 9.176A3 3 0 006.62 21h10.757a3 3 0 002.995-2.824L20.913 9H3.087zm6.163 3.75A.75.75 0 0110 12h4a.75.75 0 010 1.5h-4a.75.75 0 01-.75-.75z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <div class="sipus-stat-number">{{ number_format($stats['total_stok'] ?? 0) }}</div>
                        <div class="sipus-stat-title">Total Stok Tersedia</div>
                    </div>
                </div>

                <div class="sipus-stat-item">
                    <div class="sipus-stat-icon-wrapper sipus-stat-icon-amber">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="26" height="26">
                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <div class="sipus-stat-number">{{ number_format($stats['sedang_dipinjam'] ?? 0) }}</div>
                        <div class="sipus-stat-title">Buku Sedang Dipinjam</div>
                    </div>
                </div>

                <div class="sipus-stat-item">
                    <div class="sipus-stat-icon-wrapper sipus-stat-icon-green">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="26" height="26">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <div class="sipus-stat-number">{{ number_format($stats['dikembalikan'] ?? 0) }}</div>
                        <div class="sipus-stat-title">Total Dikembalikan</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filter & Katalog Grid Layout --}}
        <div class="sipus-catalog-layout">
            {{-- SIDEBAR FILTER --}}
            <aside class="sipus-filter-card">
                <form action="{{ route('buku.index') }}" method="GET">
                    @if ($viewMode === 'manage')
                        <input type="hidden" name="view" value="manage">
                    @endif

                    <div class="sipus-filter-title">
                        <span>Filter &amp; Pencarian</span>
                        @if (array_filter($filters))
                            <a href="{{ route('buku.index', $viewMode === 'manage' ? ['view' => 'manage'] : []) }}" style="font-size: 0.75rem; color: var(--sipus-danger); text-decoration: none; font-weight: normal;">
                                Reset Filter
                            </a>
                        @endif
                    </div>

                    {{-- Kata Kunci --}}
                    <div class="sipus-filter-group">
                        <label class="sipus-filter-label" for="filter_q">Kata Kunci</label>
                        <input type="text"
                               id="filter_q"
                               name="q"
                               class="sipus-input"
                               placeholder="Judul, penulis, ISBN..."
                               value="{{ $filters['q'] }}">
                    </div>

                    {{-- Jenis Koleksi --}}
                    <div class="sipus-filter-group">
                        <label class="sipus-filter-label" for="filter_koleksi">Jenis Koleksi</label>
                        <select name="jenis_koleksi" id="filter_koleksi" class="sipus-select">
                            <option value="">Semua Koleksi</option>
                            <option value="Buku Pelajaran" {{ $filters['jenis_koleksi'] === 'Buku Pelajaran' ? 'selected' : '' }}>
                                Buku Pelajaran (Lt. 1)
                            </option>
                            <option value="Skripsi" {{ $filters['jenis_koleksi'] === 'Skripsi' ? 'selected' : '' }}>
                                Skripsi / Tugas Akhir (Lt. 2)
                            </option>
                        </select>
                    </div>

                    {{-- Lantai --}}
                    <div class="sipus-filter-group">
                        <label class="sipus-filter-label" for="filter_lantai">Lokasi Lantai</label>
                        <select name="lantai" id="filter_lantai" class="sipus-select">
                            <option value="">Semua Lantai</option>
                            <option value="1" {{ $filters['lantai'] == '1' ? 'selected' : '' }}>
                                Lantai 1 — Buku Pelajaran
                            </option>
                            <option value="2" {{ $filters['lantai'] == '2' ? 'selected' : '' }}>
                                Lantai 2 — Skripsi &amp; TA
                            </option>
                        </select>
                    </div>

                    {{-- Kategori --}}
                    <div class="sipus-filter-group">
                        <label class="sipus-filter-label" for="filter_kategori">Kategori Keilmuan</label>
                        <select name="kategori" id="filter_kategori" class="sipus-select">
                            <option value="">Semua Kategori</option>
                            @foreach ($kategoris as $kat)
                                <option value="{{ $kat->id }}" {{ $filters['kategori'] == $kat->id ? 'selected' : '' }}>
                                    {{ $kat->kode_kategori }} — {{ $kat->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Ketersediaan Stok --}}
                    <div class="sipus-filter-group">
                        <label class="sipus-filter-label" for="filter_stok">Ketersediaan</label>
                        <select name="ketersediaan" id="filter_stok" class="sipus-select">
                            <option value="">Semua Status</option>
                            <option value="tersedia" {{ $filters['ketersediaan'] === 'tersedia' ? 'selected' : '' }}>
                                Tersedia di Perpustakaan
                            </option>
                            <option value="habis" {{ $filters['ketersediaan'] === 'habis' ? 'selected' : '' }}>
                                Stok Habis / Dipinjam
                            </option>
                        </select>
                    </div>

                    {{-- Urutan --}}
                    <div class="sipus-filter-group">
                        <label class="sipus-filter-label" for="filter_sort">Urutkan</label>
                        <select name="sort" id="filter_sort" class="sipus-select">
                            <option value="latest" {{ $filters['sort'] === 'latest' ? 'selected' : '' }}>Terbaru Ditambahkan</option>
                            <option value="judul_asc" {{ $filters['sort'] === 'judul_asc' ? 'selected' : '' }}>Judul (A - Z)</option>
                            <option value="judul_desc" {{ $filters['sort'] === 'judul_desc' ? 'selected' : '' }}>Judul (Z - A)</option>
                            <option value="tahun_desc" {{ $filters['sort'] === 'tahun_desc' ? 'selected' : '' }}>Tahun (Terbaru)</option>
                            <option value="stok_desc" {{ $filters['sort'] === 'stok_desc' ? 'selected' : '' }}>Stok Terbanyak</option>
                        </select>
                    </div>

                    <button type="submit" class="sipus-btn sipus-btn-primary w-full" style="margin-top: 0.5rem;">
                        Terapkan Filter
                    </button>
                </form>
            </aside>

            {{-- MAIN LISTING SECTION --}}
            <div>
                {{-- Info Hasil Filter --}}
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; flex-wrap: wrap; gap: 0.75rem;">
                    <div style="font-size: 0.9rem; color: var(--sipus-text-muted);">
                        Menampilkan <strong>{{ $bukus->total() }}</strong> hasil koleksi buku
                        @if ($filters['q'])
                            dengan kata kunci "<em>{{ $filters['q'] }}</em>"
                        @endif
                    </div>
                </div>

                @if ($viewMode === 'manage')
                    {{-- TAMPILAN ADMIN TABEL --}}
                    <div class="sipus-card" style="padding: 0; overflow: hidden;">
                        <div class="sipus-table-responsive">
                            <table class="sipus-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ISBN / Kode</th>
                                        <th>Judul &amp; Penulis</th>
                                        <th>Koleksi &amp; Kategori</th>
                                        <th>Lokasi (Lantai &amp; Rak)</th>
                                        <th>Stok</th>
                                        <th style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($bukus as $buku)
                                        <tr>
                                            <td style="color: var(--sipus-text-muted); font-size: 0.8rem;">
                                                {{ $bukus->firstItem() + $loop->index }}
                                            </td>
                                            <td style="font-family: monospace; font-size: 0.8rem;">
                                                {{ $buku->isbn }}
                                            </td>
                                            <td>
                                                <a href="{{ route('buku.show', $buku) }}" style="font-weight: 700; color: var(--sipus-text); text-decoration: none;">
                                                    {{ $buku->judul }}
                                                </a>
                                                <div style="font-size: 0.775rem; color: var(--sipus-text-muted);">
                                                    {{ $buku->penulis }} ({{ $buku->tahun_terbit }}) &middot; {{ $buku->penerbit }}
                                                </div>
                                            </td>
                                            <td>
                                                <span class="sipus-book-collection-badge {{ $buku->jenis_koleksi === 'Skripsi' ? 'sipus-badge-skripsi' : 'sipus-badge-pelajaran' }}">
                                                    {{ $buku->jenis_koleksi ?? 'Buku Pelajaran' }}
                                                </span>
                                                <div style="font-size: 0.75rem; color: var(--sipus-primary); font-weight: 600; margin-top: 0.2rem;">
                                                    {{ $buku->kategori?->nama_kategori ?? '—' }}
                                                </div>
                                            </td>
                                            <td>
                                                <div style="font-weight: 700; color: var(--sipus-primary-dark);">
                                                    {{ $buku->lantai ? 'Lantai ' . $buku->lantai : 'Lokasi belum ditentukan' }}
                                                </div>
                                                <div style="font-size: 0.775rem; color: var(--sipus-text-muted);">
                                                    Rak: <strong>{{ $buku->kode_rak ?? '-' }}</strong>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($buku->stok > 0)
                                                    <span class="sipus-status-pill sipus-status-available">
                                                        {{ $buku->stok }} Tersedia
                                                    </span>
                                                @else
                                                    <span class="sipus-status-pill sipus-status-empty">
                                                        Habis
                                                    </span>
                                                @endif
                                                <div style="font-size: 0.725rem; color: var(--sipus-primary); font-weight: 600; margin-top: 0.25rem;">
                                                    {{ $buku->peminjamans_count }}x dipinjam
                                                </div>
                                            </td>
                                            <td>
                                                <div style="display: flex; gap: 0.35rem; justify-content: center;">
                                                    <a href="{{ route('buku.show', $buku) }}" class="sipus-btn-sm sipus-btn-sm-info" title="Detail">
                                                        Detail
                                                    </a>
                                                    <a href="{{ route('buku.edit', $buku) }}" class="sipus-btn-sm sipus-btn-sm-warning" title="Edit">
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('buku.destroy', $buku) }}" method="POST"
                                                          onsubmit="return confirm('Hapus koleksi buku \'{{ addslashes($buku->judul) }}\'?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="sipus-btn-sm sipus-btn-sm-danger">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">
                                                <div class="sipus-empty-state">
                                                    <p>Tidak ada buku yang sesuai dengan kriteria filter.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    {{-- TAMPILAN KATALOG GRID MAHASISWA --}}
                    <div class="sipus-book-grid">
                        @forelse ($bukus as $buku)
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
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="48" height="48">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>
                                <h3>Buku tidak ditemukan</h3>
                                <p>Tidak ada koleksi yang sesuai dengan pencarian atau filter yang Anda pilih.</p>
                                <a href="{{ route('katalog') }}" class="sipus-btn sipus-btn-outline">
                                    Hapus Semua Filter
                                </a>
                            </div>
                        @endforelse
                    </div>
                @endif

                {{-- Pagination yang kompatibel dengan filter query string --}}
                @if ($bukus->hasPages())
                    <div class="sipus-pagination">
                        {{ $bukus->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

</x-layout>
