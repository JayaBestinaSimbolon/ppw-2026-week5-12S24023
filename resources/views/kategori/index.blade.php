<x-layout title="Daftar Kategori">

    <div class="sipus-container sipus-content-wrap">
        <div class="sipus-page-header">
            <div>
                <h1 class="sipus-page-title">Klasifikasi &amp; Kategori Buku</h1>
                <p class="sipus-page-subtitle">Kelola kategori koleksi perpustakaan Institut Teknologi Del</p>
            </div>
            <div style="display: flex; gap: 0.75rem;">
                <a href="{{ route('katalog') }}" class="sipus-btn sipus-btn-outline">
                    Katalog Buku
                </a>
                <a href="{{ route('kategori.create') }}" class="sipus-btn sipus-btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="16" height="16">
                        <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                    </svg>
                    Tambah Kategori
                </a>
            </div>
        </div>

        <div class="sipus-card" style="padding: 0; overflow: hidden;">
            <div class="sipus-table-responsive">
                <table class="sipus-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Kategori</th>
                            <th>Nama Kategori Keilmuan</th>
                            <th style="text-align: center;">Jumlah Koleksi Buku</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kategoris as $kategori)
                            <tr>
                                <td style="color: var(--sipus-text-muted); font-size: 0.8rem;">
                                    {{ $kategoris->firstItem() + $loop->index }}
                                </td>
                                <td>
                                    <span class="sipus-badge sipus-badge-purple">{{ $kategori->kode_kategori }}</span>
                                </td>
                                <td style="font-weight: 700; color: var(--sipus-text);">
                                    <a href="{{ route('kategori.show', $kategori) }}" style="color: inherit; text-decoration: none;">
                                        {{ $kategori->nama_kategori }}
                                    </a>
                                </td>
                                <td style="text-align: center;">
                                    <span class="sipus-badge {{ $kategori->bukus_count > 0 ? 'sipus-badge-green' : 'sipus-badge-gray' }}">
                                        {{ $kategori->bukus_count }} Koleksi
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    <div style="display: flex; gap: 0.35rem; justify-content: center;">
                                        <a href="{{ route('kategori.show', $kategori) }}" class="sipus-btn-sm sipus-btn-sm-info" title="Detail">
                                            Detail
                                        </a>
                                        <a href="{{ route('kategori.edit', $kategori) }}" class="sipus-btn-sm sipus-btn-sm-warning" title="Edit">
                                            Edit
                                        </a>
                                        <form action="{{ route('kategori.destroy', $kategori) }}" method="POST"
                                              onsubmit="return confirm('Hapus kategori \'{{ addslashes($kategori->nama_kategori) }}\'? Tindakan ini hanya dapat dilakukan jika kategori tidak memiliki koleksi buku.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="sipus-btn-sm sipus-btn-sm-danger" title="Hapus">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="sipus-empty-state">
                                        <p>Belum ada kategori buku di basis data.</p>
                                        <a href="{{ route('kategori.create') }}" class="sipus-btn sipus-btn-primary">+ Tambah Kategori Pertama</a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($kategoris->hasPages())
                <div class="sipus-pagination">
                    {{ $kategoris->links() }}
                </div>
            @endif
        </div>
    </div>

</x-layout>
