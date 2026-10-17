<x-layout title="Tambah Kategori">

    <div class="sipus-container sipus-content-wrap">
        <div class="sipus-page-header">
            <div>
                <h1 class="sipus-page-title">Tambah Kategori Baru</h1>
                <p class="sipus-page-subtitle">Klasifikasikan bidang keilmuan untuk pengelompokan buku dan skripsi</p>
            </div>
            <a href="{{ route('kategori.index') }}" class="sipus-btn sipus-btn-outline">
                &larr; Kembali ke Daftar
            </a>
        </div>

        <div class="sipus-card sipus-form-card sipus-form-narrow">
            <form action="{{ route('kategori.store') }}" method="POST" novalidate>
                @csrf

                {{-- Kode Kategori --}}
                <div class="sipus-form-group">
                    <label for="kode_kategori" class="sipus-label">Kode Singkat Kategori <span class="sipus-required">*</span></label>
                    <input type="text" id="kode_kategori" name="kode_kategori"
                           class="sipus-input @error('kode_kategori') is-invalid @enderror"
                           value="{{ old('kode_kategori') }}"
                           placeholder="Contoh: TI, PRG, BD, AI"
                           maxlength="20">
                    <p class="sipus-hint">Kode unik huruf kapital untuk identifikasi cepat rak dan buku</p>
                    @error('kode_kategori')
                        <div class="sipus-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Nama Kategori --}}
                <div class="sipus-form-group">
                    <label for="nama_kategori" class="sipus-label">Nama Kategori Keilmuan <span class="sipus-required">*</span></label>
                    <input type="text" id="nama_kategori" name="nama_kategori"
                           class="sipus-input @error('nama_kategori') is-invalid @enderror"
                           value="{{ old('nama_kategori') }}"
                           placeholder="Contoh: Kecerdasan Buatan">
                    @error('nama_kategori')
                        <div class="sipus-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Form Actions --}}
                <div class="sipus-form-actions">
                    <a href="{{ route('kategori.index') }}" class="sipus-btn sipus-btn-ghost">Batal</a>
                    <button type="submit" class="sipus-btn sipus-btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="16" height="16">
                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                        </svg>
                        Simpan Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-layout>
