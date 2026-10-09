<x-layout title="Tambah Buku">

    <div class="sipus-page-header">
        <div>
            <h1 class="sipus-page-title">Tambah Buku</h1>
            <p class="sipus-page-subtitle">Tambahkan buku baru ke koleksi perpustakaan</p>
        </div>
        <a href="{{ route('buku.index') }}" class="sipus-btn sipus-btn-outline">
            ← Kembali ke Daftar
        </a>
    </div>

    <div class="sipus-card sipus-form-card">
        <form action="{{ route('buku.store') }}" method="POST" novalidate>
            @csrf

            <div class="sipus-form-grid">
                {{-- ISBN --}}
                <div class="sipus-form-group">
                    <label for="isbn" class="sipus-label">ISBN <span class="sipus-required">*</span></label>
                    <input type="text" id="isbn" name="isbn"
                           class="sipus-input @error('isbn') is-invalid @enderror"
                           value="{{ old('isbn') }}"
                           placeholder="Contoh: 978-602-1230-01-1">
                    @error('isbn')
                        <div class="sipus-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Judul --}}
                <div class="sipus-form-group sipus-form-group-full">
                    <label for="judul" class="sipus-label">Judul Buku <span class="sipus-required">*</span></label>
                    <input type="text" id="judul" name="judul"
                           class="sipus-input @error('judul') is-invalid @enderror"
                           value="{{ old('judul') }}"
                           placeholder="Masukkan judul buku">
                    @error('judul')
                        <div class="sipus-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Penulis --}}
                <div class="sipus-form-group">
                    <label for="penulis" class="sipus-label">Penulis <span class="sipus-required">*</span></label>
                    <input type="text" id="penulis" name="penulis"
                           class="sipus-input @error('penulis') is-invalid @enderror"
                           value="{{ old('penulis') }}"
                           placeholder="Nama penulis buku">
                    @error('penulis')
                        <div class="sipus-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Penerbit --}}
                <div class="sipus-form-group">
                    <label for="penerbit" class="sipus-label">Penerbit <span class="sipus-required">*</span></label>
                    <input type="text" id="penerbit" name="penerbit"
                           class="sipus-input @error('penerbit') is-invalid @enderror"
                           value="{{ old('penerbit') }}"
                           placeholder="Nama penerbit">
                    @error('penerbit')
                        <div class="sipus-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tahun Terbit --}}
                <div class="sipus-form-group">
                    <label for="tahun_terbit" class="sipus-label">Tahun Terbit <span class="sipus-required">*</span></label>
                    <input type="number" id="tahun_terbit" name="tahun_terbit"
                           class="sipus-input @error('tahun_terbit') is-invalid @enderror"
                           value="{{ old('tahun_terbit') }}"
                           placeholder="{{ date('Y') }}" min="1900" max="{{ date('Y') + 1 }}">
                    @error('tahun_terbit')
                        <div class="sipus-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Kategori --}}
                <div class="sipus-form-group">
                    <label for="kategori_id" class="sipus-label">Kategori <span class="sipus-required">*</span></label>
                    <select id="kategori_id" name="kategori_id"
                            class="sipus-select @error('kategori_id') is-invalid @enderror">
                        <option value="">— Pilih Kategori —</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}"
                                {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->kode_kategori }} — {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <div class="sipus-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Stok --}}
                <div class="sipus-form-group">
                    <label for="stok" class="sipus-label">Stok <span class="sipus-required">*</span></label>
                    <input type="number" id="stok" name="stok"
                           class="sipus-input @error('stok') is-invalid @enderror"
                           value="{{ old('stok', 0) }}"
                           min="0">
                    @error('stok')
                        <div class="sipus-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Sinopsis --}}
                <div class="sipus-form-group sipus-form-group-full">
                    <label for="sinopsis" class="sipus-label">Sinopsis <span class="sipus-optional">(opsional)</span></label>
                    <textarea id="sinopsis" name="sinopsis" rows="4"
                              class="sipus-textarea @error('sinopsis') is-invalid @enderror"
                              placeholder="Masukkan sinopsis atau deskripsi singkat buku ini...">{{ old('sinopsis') }}</textarea>
                    @error('sinopsis')
                        <div class="sipus-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Form Actions --}}
            <div class="sipus-form-actions">
                <a href="{{ route('buku.index') }}" class="sipus-btn sipus-btn-ghost">Batal</a>
                <button type="submit" class="sipus-btn sipus-btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" /></svg>
                    Simpan Buku
                </button>
            </div>
        </form>
    </div>

</x-layout>
