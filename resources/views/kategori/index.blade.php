<x-layout title="Daftar Kategori">

    <div class="sipus-page-header">
        <div>
            <h1 class="sipus-page-title">Kategori Buku</h1>
            <p class="sipus-page-subtitle">Kelola kategori koleksi perpustakaan</p>
        </div>
        <a href="{{ route('kategori.create') }}" class="sipus-btn sipus-btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path fill-rule="evenodd" d="M12 3.75a.75.75 0 01.75.75v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5a.75.75 0 01.75-.75z" clip-rule="evenodd" /></svg>
            Tambah Kategori
        </a>
    </div>

    <div class="sipus-card">
        <div class="sipus-table-responsive">
            <table class="sipus-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Kategori</th>
                        <th class="text-center">Jumlah Buku</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kategoris as $kategori)
                        <tr>
                            <td class="sipus-td-no">{{ $kategoris->firstItem() + $loop->index }}</td>
                            <td>
                                <span class="sipus-badge sipus-badge-purple">{{ $kategori->kode_kategori }}</span>
                            </td>
                            <td class="sipus-td-judul">{{ $kategori->nama_kategori }}</td>
                            <td class="text-center">
                                <span class="sipus-badge {{ $kategori->bukus_count > 0 ? 'sipus-badge-green' : 'sipus-badge-gray' }}">
                                    {{ $kategori->bukus_count }} Buku
                                </span>
                            </td>
                            <td class="sipus-td-aksi">
                                <div class="sipus-action-group">
                                    <a href="{{ route('kategori.show', $kategori) }}" class="sipus-btn-sm sipus-btn-sm-info" title="Detail">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="14" height="14"><path d="M12 15a3 3 0 100-6 3 3 0 000 6z" /><path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" clip-rule="evenodd" /></svg>
                                        Detail
                                    </a>
                                    <a href="{{ route('kategori.edit', $kategori) }}" class="sipus-btn-sm sipus-btn-sm-warning" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="14" height="14"><path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" /></svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('kategori.destroy', $kategori) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus kategori \'{{ addslashes($kategori->nama_kategori) }}\'? Kategori hanya bisa dihapus jika tidak memiliki buku.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="sipus-btn-sm sipus-btn-sm-danger" title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="14" height="14"><path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" /></svg>
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
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="48" height="48">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                                    </svg>
                                    <p>Belum ada kategori buku.</p>
                                    <a href="{{ route('kategori.create') }}" class="sipus-btn sipus-btn-primary">+ Tambah Kategori Pertama</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($kategoris->hasPages())
            <div class="sipus-pagination">
                {{ $kategoris->links() }}
            </div>
        @endif
    </div>

</x-layout>
