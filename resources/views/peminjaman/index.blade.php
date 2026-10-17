<x-layout title="Sirkulasi Peminjaman Buku">

    <div class="sipus-container sipus-content-wrap">
        {{-- Header Halaman --}}
        <div class="sipus-page-header">
            <div>
                <h1 class="sipus-page-title">Sirkulasi &amp; Peminjaman Buku</h1>
                <p class="sipus-page-subtitle">
                    Pencatatan sirkulasi peminjaman dan pengembalian koleksi buku berbasis transaksi ACID &amp; Concurrency Locking
                </p>
            </div>
            <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
                <a href="{{ route('katalog') }}" class="sipus-btn sipus-btn-outline">
                    &larr; Lihat Katalog Buku
                </a>
            </div>
        </div>

        {{-- Kartu Statistik Sirkulasi Menggunakan DB::table() --}}
        <div class="sipus-stats-band" style="margin-bottom: 2rem;">
            <div class="sipus-stats-card-grid">
                <div class="sipus-stat-item">
                    <div class="sipus-stat-icon-wrapper sipus-stat-icon-purple">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="26" height="26">
                            <path d="M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 20.636A8.214 8.214 0 0118 18.75c.966 0 1.89.166 2.75.47a.75.75 0 001-.708V4.262a.75.75 0 00-.5-.707A9.735 9.735 0 0018 3a9.707 9.707 0 00-5.25 1.533v16.103z" />
                        </svg>
                    </div>
                    <div>
                        <div class="sipus-stat-number">{{ number_format($stats['total_transaksi']) }}</div>
                        <div class="sipus-stat-title">Total Transaksi Sirkulasi</div>
                    </div>
                </div>

                <div class="sipus-stat-item">
                    <div class="sipus-stat-icon-wrapper sipus-stat-icon-amber">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="26" height="26">
                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <div class="sipus-stat-number">{{ number_format($stats['sedang_dipinjam']) }}</div>
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
                        <div class="sipus-stat-number">{{ number_format($stats['dikembalikan']) }}</div>
                        <div class="sipus-stat-title">Buku Sudah Dikembalikan</div>
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
                        <div class="sipus-stat-number">{{ number_format($stats['total_stok']) }}</div>
                        <div class="sipus-stat-title">Total Stok Fisik Tersedia</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Form Peminjaman Baru (ACID & Concurrency Safe) --}}
        <div class="sipus-card" style="margin-bottom: 2rem; border-top: 4px solid var(--sipus-primary);">
            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.25rem;">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="20" height="20" style="color: var(--sipus-primary);">
                    <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                </svg>
                <h3 style="font-size: 1.15rem; font-weight: 700; margin: 0; color: var(--sipus-text);">
                    Pencatatan Peminjaman Buku Baru (Pessimistic Lock &amp; Atomik)
                </h3>
            </div>

            <form action="{{ route('peminjaman.store') }}" method="POST">
                @csrf
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1rem; margin-bottom: 1rem;">
                    <div>
                        <label for="buku_id" class="sipus-filter-label" style="font-weight: 600;">
                            Pilih Buku &amp; Ketersediaan Stok <span style="color: var(--sipus-danger);">*</span>
                        </label>
                        <select name="buku_id" id="buku_id" class="sipus-input" required>
                            <option value="">-- Pilih Buku --</option>
                            @foreach ($bukus as $b)
                                <option value="{{ $b->id }}" {{ old('buku_id', request('buku_id')) == $b->id ? 'selected' : '' }}>
                                    {{ $b->judul }} &mdash; (Sisa Stok: {{ $b->stok }} eks{{ $b->stok == 0 ? ' - HABIS' : '' }})
                                </option>
                            @endforeach
                        </select>
                        @error('buku_id')
                            <div style="font-size: 0.775rem; color: var(--sipus-danger); margin-top: 0.25rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="nim_peminjam" class="sipus-filter-label" style="font-weight: 600;">
                            NIM Mahasiswa Peminjam <span style="color: var(--sipus-danger);">*</span>
                        </label>
                        <input type="text"
                               name="nim_peminjam"
                               id="nim_peminjam"
                               class="sipus-input"
                               placeholder="Contoh: 12S24023"
                               value="{{ old('nim_peminjam') }}"
                               required>
                        @error('nim_peminjam')
                            <div style="font-size: 0.775rem; color: var(--sipus-danger); margin-top: 0.25rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="nama_peminjam" class="sipus-filter-label" style="font-weight: 600;">
                            Nama Lengkap Mahasiswa <span style="color: var(--sipus-danger);">*</span>
                        </label>
                        <input type="text"
                               name="nama_peminjam"
                               id="nama_peminjam"
                               class="sipus-input"
                               placeholder="Nama peminjam..."
                               value="{{ old('nama_peminjam') }}"
                               required>
                        @error('nama_peminjam')
                            <div style="font-size: 0.775rem; color: var(--sipus-danger); margin-top: 0.25rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_pinjam" class="sipus-filter-label" style="font-weight: 600;">
                            Tanggal Pinjam <span style="color: var(--sipus-danger);">*</span>
                        </label>
                        <input type="date"
                               name="tanggal_pinjam"
                               id="tanggal_pinjam"
                               class="sipus-input"
                               value="{{ old('tanggal_pinjam', now()->toDateString()) }}"
                               required>
                        @error('tanggal_pinjam')
                            <div style="font-size: 0.775rem; color: var(--sipus-danger); margin-top: 0.25rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_jatuh_tempo" class="sipus-filter-label" style="font-weight: 600;">
                            Tanggal Jatuh Tempo (Default 7 Hari) <span style="color: var(--sipus-danger);">*</span>
                        </label>
                        <input type="date"
                               name="tanggal_jatuh_tempo"
                               id="tanggal_jatuh_tempo"
                               class="sipus-input"
                               value="{{ old('tanggal_jatuh_tempo', now()->addDays(7)->toDateString()) }}"
                               required>
                        @error('tanggal_jatuh_tempo')
                            <div style="font-size: 0.775rem; color: var(--sipus-danger); margin-top: 0.25rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end; align-items: center; gap: 1rem;">
                    <span style="font-size: 0.8rem; color: var(--sipus-text-muted);">
                        * Sistem secara otomatis mengunci baris buku menggunakan <code>lockForUpdate()</code> dan menolak jika stok 0.
                    </span>
                    <button type="submit" class="sipus-btn sipus-btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="16" height="16">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-11.25a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z" clip-rule="evenodd" />
                        </svg>
                        Proses Peminjaman (ACID)
                    </button>
                </div>
            </form>
        </div>

        {{-- Filter & Daftar Riwayat Peminjaman --}}
        <div class="sipus-card" style="padding: 0; overflow: hidden;">
            {{-- Filter Bar --}}
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--sipus-border-subtle); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <h3 style="margin: 0 0 0.25rem 0; font-size: 1.1rem; font-weight: 700; color: var(--sipus-text);">
                        Daftar Transaksi Sirkulasi
                    </h3>
                    <p style="margin: 0; font-size: 0.85rem; color: var(--sipus-text-muted);">
                        Menampilkan <strong>{{ $peminjamans->total() }}</strong> catatan transaksi sirkulasi
                    </p>
                </div>

                <form action="{{ route('peminjaman.index') }}" method="GET" style="display: flex; gap: 0.5rem; flex-wrap: wrap; align-items: center;">
                    <select name="status" class="sipus-input" style="width: auto; padding: 0.45rem 0.75rem; font-size: 0.85rem;" onchange="this.form.submit()">
                        <option value="">-- Semua Status --</option>
                        <option value="dipinjam" {{ $status === 'dipinjam' ? 'selected' : '' }}>Sedang Dipinjam</option>
                        <option value="dikembalikan" {{ $status === 'dikembalikan' ? 'selected' : '' }}>Sudah Dikembalikan</option>
                    </select>

                    <input type="text"
                           name="q"
                           class="sipus-input"
                           style="width: 240px; padding: 0.45rem 0.75rem; font-size: 0.85rem;"
                           placeholder="Cari NIM, Nama, Kode, Buku..."
                           value="{{ $q }}">

                    <button type="submit" class="sipus-btn sipus-btn-primary" style="padding: 0.45rem 0.9rem; font-size: 0.85rem;">
                        Filter
                    </button>

                    @if ($status || $q)
                        <a href="{{ route('peminjaman.index') }}" class="sipus-btn sipus-btn-ghost" style="padding: 0.45rem 0.75rem; font-size: 0.85rem;">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            {{-- Tabel Sirkulasi --}}
            <div class="sipus-table-responsive">
                <table class="sipus-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Pinjam</th>
                            <th>Koleksi Buku</th>
                            <th>Mahasiswa Peminjam</th>
                            <th>Tgl Pinjam &amp; Tempo</th>
                            <th>Status Transaksi</th>
                            <th style="text-align: center;">Aksi Sirkulasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($peminjamans as $pmj)
                            <tr>
                                <td style="color: var(--sipus-text-muted); font-size: 0.8rem;">
                                    {{ $peminjamans->firstItem() + $loop->index }}
                                </td>
                                <td>
                                    <strong style="font-family: monospace; font-size: 0.85rem; color: var(--sipus-primary-dark);">
                                        {{ $pmj->kode_pinjam }}
                                    </strong>
                                    <div style="font-size: 0.75rem; color: var(--sipus-text-muted);">
                                        {{ $pmj->created_at->diffForHumans() }}
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('buku.show', $pmj->buku_id) }}" style="font-weight: 700; color: var(--sipus-text); text-decoration: none;">
                                        {{ $pmj->buku?->judul ?? '[Buku Dihapus]' }}
                                    </a>
                                    <div style="font-size: 0.775rem; color: var(--sipus-text-muted);">
                                        {{ $pmj->buku?->lantai ? 'Lt. ' . $pmj->buku->lantai : '' }}
                                        {{ $pmj->buku?->kode_rak ? '&middot; Rak ' . $pmj->buku->kode_rak : '' }}
                                        &middot; Sisa Stok: <strong>{{ $pmj->buku?->stok ?? 0 }}</strong> eks
                                    </div>
                                </td>
                                <td>
                                    <div style="font-weight: 600; color: var(--sipus-text);">
                                        {{ $pmj->nama_peminjam }}
                                    </div>
                                    <div style="font-family: monospace; font-size: 0.8rem; color: var(--sipus-text-muted);">
                                        NIM: {{ $pmj->nim_peminjam }}
                                    </div>
                                </td>
                                <td>
                                    <div style="font-size: 0.825rem;">
                                        Pinjam: <strong>{{ $pmj->tanggal_pinjam?->format('d M Y') }}</strong>
                                    </div>
                                    <div style="font-size: 0.825rem; color: var(--sipus-danger); margin-top: 0.15rem;">
                                        Tempo: <strong>{{ $pmj->tanggal_jatuh_tempo?->format('d M Y') }}</strong>
                                    </div>
                                </td>
                                <td>
                                    @if ($pmj->status === 'dipinjam')
                                        <span class="sipus-status-pill sipus-status-empty" style="background: #FEF3C7; color: #92400E; border: 1px solid #FCD34D;">
                                            <span class="sipus-status-dot" style="background: #D97706;"></span>
                                            Sedang Dipinjam
                                        </span>
                                    @else
                                        <span class="sipus-status-pill sipus-status-available">
                                            <span class="sipus-status-dot"></span>
                                            Dikembalikan ({{ $pmj->tanggal_kembali?->format('d M Y') ?? '-' }})
                                        </span>
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    @if ($pmj->status === 'dipinjam')
                                        <form action="{{ route('peminjaman.kembali', $pmj->id) }}" method="POST"
                                              onsubmit="return confirm('Proses pengembalian buku untuk kode \'{{ $pmj->kode_pinjam }}\'? Stok buku akan bertambah 1.')">
                                            @csrf
                                            <button type="submit" class="sipus-btn-sm sipus-btn-sm-warning" style="display: inline-flex; align-items: center; gap: 0.25rem;">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="14" height="14">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-11.25a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z" clip-rule="evenodd" />
                                                </svg>
                                                Kembalikan Buku
                                            </button>
                                        </form>
                                    @else
                                        <span style="font-size: 0.775rem; color: var(--sipus-text-muted); font-style: italic;">
                                            Transaksi Selesai
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="sipus-empty-state">
                                        <p>Tidak ada catatan sirkulasi peminjaman yang ditemukan.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination Links --}}
            @if ($peminjamans->hasPages())
                <div style="padding: 1.25rem 1.5rem; border-top: 1px solid var(--sipus-border-subtle);">
                    {{ $peminjamans->links() }}
                </div>
            @endif
        </div>
    </div>

</x-layout>
