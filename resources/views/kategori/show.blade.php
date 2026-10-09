<x-layout title="{{ $kategori->nama_kategori }}">

    <div class="sipus-page-header">
        <div>
            <h1 class="sipus-page-title">Detail Kategori</h1>
            <p class="sipus-page-subtitle">Informasi dan koleksi buku dalam kategori ini</p>
        </div>
        <a href="{{ route('kategori.index') }}" class="sipus-btn sipus-btn-outline">
            ← Kembali ke Daftar
        </a>
    </div>

    <div class="sipus-detail-layout">
        {{-- Main Info --}}
        <div class="sipus-card sipus-detail-main">
            <div class="sipus-detail-header">
                <div class="sipus-detail-book-icon sipus-detail-tag-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="40" height="40">
                        <path fill-rule="evenodd" d="M5.25 2.25a3 3 0 00-3 3v4.318a3 3 0 00.879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 005.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 00-2.121-.879H5.25zM6.375 7.5a1.125 1.125 0 100-2.25 1.125 1.125 0 000 2.25z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <h2 class="sipus-detail-title">{{ $kategori->nama_kategori }}</h2>
                    <p class="sipus-detail-penulis">Kode: <span class="sipus-mono">{{ $kategori->kode_kategori }}</span></p>
                    <div class="sipus-detail-badges">
                        <span class="sipus-badge sipus-badge-purple">{{ $kategori->kode_kategori }}</span>
                        <span class="sipus-badge sipus-badge-green">{{ $bukus->total() }} Buku</span>
                    </div>
                </div>
            </div>

            <div class="sipus-info-grid">
                <div class="sipus-info-item">
                    <div class="sipus-info-label">Kode Kategori</div>
                    <div class="sipus-info-value sipus-mono">{{ $kategori->kode_kategori }}</div>
                </div>
                <div class="sipus-info-item">
                    <div class="sipus-info-label">Nama Kategori</div>
                    <div class="sipus-info-value">{{ $kategori->nama_kategori }}</div>
                </div>
                <div class="sipus-info-item">
                    <div class="sipus-info-label">Jumlah Buku</div>
                    <div class="sipus-info-value">{{ $bukus->total() }} judul</div>
                </div>
                <div class="sipus-info-item">
                    <div class="sipus-info-label">Dibuat pada</div>
                    <div class="sipus-info-value">{{ $kategori->created_at->format('d M Y') }}</div>
                </div>
            </div>

            {{-- Daftar Buku dalam Kategori --}}
            <div class="sipus-sinopsis" style="margin-top: 1.5rem;">
                <div class="sipus-sinopsis-title">Koleksi Buku dalam Kategori Ini</div>

                @forelse ($bukus as $buku)
                    <div class="sipus-list-item">
                        <div class="sipus-list-item-info">
                            <div class="sipus-list-item-title">
                                <a href="{{ route('buku.show', $buku) }}" class="sipus-link">{{ $buku->judul }}</a>
                            </div>
                            <div class="sipus-list-item-meta">{{ $buku->penulis }} &middot; {{ $buku->penerbit }} &middot; {{ $buku->tahun_terbit }}</div>
                        </div>
                        <div class="sipus-list-item-badges">
                            @if ($buku->stok === 0)
                                <span class="sipus-badge sipus-badge-red">Habis</span>
                            @elseif ($buku->stok <= 3)
                                <span class="sipus-badge sipus-badge-yellow">{{ $buku->stok }} eks</span>
                            @else
                                <span class="sipus-badge sipus-badge-green">{{ $buku->stok }} eks</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="sipus-empty-state" style="padding: 1.5rem 0;">
                        <p>Belum ada buku dalam kategori ini.</p>
                        <a href="{{ route('buku.create') }}" class="sipus-btn sipus-btn-primary" style="margin-top: 0.5rem;">+ Tambah Buku</a>
                    </div>
                @endforelse

                @if ($bukus->hasPages())
                    <div class="sipus-pagination">
                        {{ $bukus->links() }}
                    </div>
                @endif
            </div>
        </div>

        {{-- Actions Sidebar --}}
        <div class="sipus-detail-sidebar">
            <div class="sipus-card">
                <h4 class="sipus-sidebar-title">Tindakan</h4>
                <div class="sipus-sidebar-actions">
                    <a href="{{ route('kategori.edit', $kategori) }}" class="sipus-btn sipus-btn-primary w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" /></svg>
                        Edit Kategori
                    </a>
                    <form action="{{ route('kategori.destroy', $kategori) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus kategori ini? Kategori hanya bisa dihapus jika tidak memiliki buku.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="sipus-btn sipus-btn-danger w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" /></svg>
                            Hapus Kategori
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layout>
