<x-layout title="Edit Kategori">

    <div class="sipus-page-header">
        <div>
            <h1 class="sipus-page-title">Edit Kategori</h1>
            <p class="sipus-page-subtitle">Perbarui data kategori: <strong>{{ $kategori->nama_kategori }}</strong></p>
        </div>
        <a href="{{ route('kategori.show', $kategori) }}" class="sipus-btn sipus-btn-outline">
            ← Kembali ke Detail
        </a>
    </div>

    <div class="sipus-card sipus-form-card sipus-form-narrow">
        <form action="{{ route('kategori.update', $kategori) }}" method="POST" novalidate>
            @csrf
            @method('PUT')

            {{-- Kode Kategori --}}
            <div class="sipus-form-group">
                <label for="kode_kategori" class="sipus-label">Kode Kategori <span class="sipus-required">*</span></label>
                <input type="text" id="kode_kategori" name="kode_kategori"
                       class="sipus-input @error('kode_kategori') is-invalid @enderror"
                       value="{{ old('kode_kategori', $kategori->kode_kategori) }}"
                       placeholder="Contoh: TI, PRG, BD"
                       maxlength="20">
                <p class="sipus-hint">Kode singkat unik, contoh: TI, PRG, BD, SI</p>
                @error('kode_kategori')
                    <div class="sipus-error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Nama Kategori --}}
            <div class="sipus-form-group">
                <label for="nama_kategori" class="sipus-label">Nama Kategori <span class="sipus-required">*</span></label>
                <input type="text" id="nama_kategori" name="nama_kategori"
                       class="sipus-input @error('nama_kategori') is-invalid @enderror"
                       value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                       placeholder="Contoh: Teknologi Informasi">
                @error('nama_kategori')
                    <div class="sipus-error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Form Actions --}}
            <div class="sipus-form-actions">
                <a href="{{ route('kategori.show', $kategori) }}" class="sipus-btn sipus-btn-ghost">Batal</a>
                <button type="submit" class="sipus-btn sipus-btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" /></svg>
                    Perbarui Kategori
                </button>
            </div>
        </form>
    </div>

</x-layout>
