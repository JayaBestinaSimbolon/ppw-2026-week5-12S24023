<x-layout title="Kategori — {{ $kategori->nama_kategori }}">

    <div class="sipus-container sipus-content-wrap">
        <div class="sipus-page-header">
            <div>
                <h1 class="sipus-page-title">Detail Kategori: {{ $kategori->nama_kategori }}</h1>
                <p class="sipus-page-subtitle">Daftar koleksi buku dan skripsi dalam kelompok keilmuan ini</p>
            </div>
            <a href="{{ route('kategori.index') }}" class="sipus-btn sipus-btn-outline">
                &larr; Kembali ke Daftar Kategori
            </a>
        </div>

        <div class="sipus-detail-layout">
            {{-- Main Info --}}
            <div class="sipus-card sipus-detail-main">
                <div class="sipus-detail-header">
                    <div class="sipus-detail-book-icon sipus-detail-tag-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="36" height="36">
                            <path fill-rule="evenodd" d="M5.25 2.25a3 3 0 00-3 3v4.318a3 3 0 00.879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 005.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 00-2.121-.879H5.25zM6.375 7.5a1.125 1.125 0 100-2.25 1.125 1.125 0 000 2.25z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <div style="margin-bottom: 0.35rem;">
                            <span class="sipus-badge sipus-badge-purple">{{ $kategori->kode_kategori }}</span>
                            <span class="sipus-badge sipus-badge-green">{{ $bukus->total() }} Judul Terdaftar</span>
                        </div>
                        <h2 class="sipus-detail-title">{{ $kategori->nama_kategori }}</h2>
                        <p class="sipus-detail-penulis">Kode Klasifikasi: <span class="sipus-mono" style="font-weight: 700;">{{ $kategori->kode_kategori }}</span></p>
                    </div>
                </div>

                {{-- Koleksi Buku dalam Kategori --}}
                <div style="margin-top: 1.5rem;">
                    <h3 style="font-size: 1.05rem; font-weight: 700; color: var(--sipus-primary); margin: 0 0 1rem;">
                        Koleksi Buku &amp; Skripsi dalam Kategori Ini
                    </h3>

                    <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                        @forelse ($bukus as $buku)
                            <div class="sipus-list-item" style="padding: 0.85rem; border: 1px solid var(--sipus-border-subtle); border-radius: 8px;">
                                <div style="flex: 1;">
                                    <div style="display: flex; gap: 0.4rem; align-items: center; margin-bottom: 0.25rem;">
                                        <span class="sipus-book-collection-badge {{ $buku->jenis_koleksi === 'Skripsi' ? 'sipus-badge-skripsi' : 'sipus-badge-pelajaran' }}" style="font-size: 0.675rem;">
                                            {{ $buku->jenis_koleksi ?? 'Buku Pelajaran' }}
                                        </span>
                                        <span style="font-size: 0.75rem; color: var(--sipus-text-muted);">
                                            {{ $buku->lantai ? 'Lantai ' . $buku->lantai : 'Lokasi belum ditentukan' }} &middot; Rak {{ $buku->kode_rak ?? '-' }}
                                        </span>
                                    </div>
                                    <div class="sipus-list-item-title">
                                        <a href="{{ route('buku.show', $buku) }}" style="color: var(--sipus-text); text-decoration: none; font-weight: 700;">
                                            {{ $buku->judul }}
                                        </a>
                                    </div>
                                    <div class="sipus-list-item-meta">{{ $buku->penulis }} &middot; {{ $buku->penerbit }} ({{ $buku->tahun_terbit }})</div>
                                </div>
                                <div class="sipus-list-item-badges">
                                    @if ($buku->stok > 0)
                                        <span class="sipus-status-pill sipus-status-available">{{ $buku->stok }} eks</span>
                                    @else
                                        <span class="sipus-status-pill sipus-status-empty">Habis</span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="sipus-empty-state" style="padding: 2rem 0;">
                                <p>Belum ada koleksi buku dalam kategori ini.</p>
                                <a href="{{ route('buku.create') }}" class="sipus-btn sipus-btn-primary">+ Tambah Buku</a>
                            </div>
                        @endforelse
                    </div>

                    @if ($bukus->hasPages())
                        <div class="sipus-pagination">
                            {{ $bukus->links() }}
                        </div>
                    @endif
                </div>
            </div>

            {{-- Sidebar Tindakan --}}
            <div class="sipus-detail-sidebar">
                <div class="sipus-card">
                    <h4 class="sipus-sidebar-title">Kelola Kategori</h4>
                    <div class="sipus-sidebar-actions">
                        <a href="{{ route('kategori.edit', $kategori) }}" class="sipus-btn sipus-btn-primary w-full">
                            Edit Kategori
                        </a>
                        <form action="{{ route('kategori.destroy', $kategori) }}" method="POST"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="sipus-btn sipus-btn-danger w-full">
                                Hapus Kategori
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>
