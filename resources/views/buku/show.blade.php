<x-layout title="{{ $buku->judul }}">

    <div class="sipus-page-header">
        <div>
            <h1 class="sipus-page-title">Detail Buku</h1>
            <p class="sipus-page-subtitle">Informasi lengkap koleksi perpustakaan</p>
        </div>
        <a href="{{ route('buku.index') }}" class="sipus-btn sipus-btn-outline">
            ← Kembali ke Daftar
        </a>
    </div>

    <div class="sipus-detail-layout">
        {{-- Main Info --}}
        <div class="sipus-card sipus-detail-main">
            <div class="sipus-detail-header">
                <div class="sipus-detail-book-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="40" height="40">
                        <path d="M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 20.636A8.214 8.214 0 0118 18.75c.966 0 1.89.166 2.75.47a.75.75 0 001-.708V4.262a.75.75 0 00-.5-.707A9.735 9.735 0 0018 3a9.707 9.707 0 00-5.25 1.533v16.103z" />
                    </svg>
                </div>
                <div>
                    <h2 class="sipus-detail-title">{{ $buku->judul }}</h2>
                    <p class="sipus-detail-penulis">{{ $buku->penulis }}</p>
                    <div class="sipus-detail-badges">
                        @if ($buku->kategori)
                            <span class="sipus-badge sipus-badge-purple">{{ $buku->kategori->kode_kategori }} — {{ $buku->kategori->nama_kategori }}</span>
                        @endif
                        @if ($buku->stok === 0)
                            <span class="sipus-badge sipus-badge-red">Stok Habis</span>
                        @elseif ($buku->stok <= 3)
                            <span class="sipus-badge sipus-badge-yellow">Stok Terbatas</span>
                        @else
                            <span class="sipus-badge sipus-badge-green">Stok Tersedia</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Info Grid --}}
            <div class="sipus-info-grid">
                <div class="sipus-info-item">
                    <div class="sipus-info-label">ISBN</div>
                    <div class="sipus-info-value sipus-mono">{{ $buku->isbn }}</div>
                </div>
                <div class="sipus-info-item">
                    <div class="sipus-info-label">Penerbit</div>
                    <div class="sipus-info-value">{{ $buku->penerbit }}</div>
                </div>
                <div class="sipus-info-item">
                    <div class="sipus-info-label">Tahun Terbit</div>
                    <div class="sipus-info-value">{{ $buku->tahun_terbit }}</div>
                </div>
                <div class="sipus-info-item">
                    <div class="sipus-info-label">Jumlah Stok</div>
                    <div class="sipus-info-value">{{ $buku->stok }} eksemplar</div>
                </div>
                <div class="sipus-info-item">
                    <div class="sipus-info-label">Kategori</div>
                    <div class="sipus-info-value">{{ $buku->kategori?->nama_kategori ?? '—' }}</div>
                </div>
                <div class="sipus-info-item">
                    <div class="sipus-info-label">Ditambahkan</div>
                    <div class="sipus-info-value">{{ $buku->created_at->format('d M Y') }}</div>
                </div>
            </div>

            {{-- Sinopsis --}}
            @if ($buku->sinopsis)
                <div class="sipus-sinopsis">
                    <div class="sipus-sinopsis-title">Sinopsis</div>
                    <p class="sipus-sinopsis-text">{{ $buku->sinopsis }}</p>
                </div>
            @endif
        </div>

        {{-- Actions Sidebar --}}
        <div class="sipus-detail-sidebar">
            <div class="sipus-card">
                <h4 class="sipus-sidebar-title">Tindakan</h4>
                <div class="sipus-sidebar-actions">
                    <a href="{{ route('buku.edit', $buku) }}" class="sipus-btn sipus-btn-primary w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" /></svg>
                        Edit Buku
                    </a>
                    <form action="{{ route('buku.destroy', $buku) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus buku ini? Tindakan ini tidak dapat dibatalkan.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="sipus-btn sipus-btn-danger w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" /></svg>
                            Hapus Buku
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layout>
