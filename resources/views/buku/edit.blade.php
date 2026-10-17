<x-layout title="Edit Buku — {{ $buku->judul }}">

    <div class="sipus-container sipus-content-wrap">
        <div class="sipus-page-header">
            <div>
                <h1 class="sipus-page-title">Edit Koleksi Buku</h1>
                <p class="sipus-page-subtitle">Perbarui data buku, pemindahan lantai, atau penomoran rak</p>
            </div>
            <a href="{{ route('buku.show', $buku) }}" class="sipus-btn sipus-btn-outline">
                &larr; Kembali ke Detail
            </a>
        </div>

        <div class="sipus-card sipus-form-card">
            <form action="{{ route('buku.update', $buku) }}" method="POST" novalidate>
                @csrf
                @method('PUT')

                <div class="sipus-form-grid">
                    {{-- ISBN / Kode Dokumen --}}
                    <div class="sipus-form-group">
                        <label for="isbn" class="sipus-label">ISBN / Kode Unik Dokumen <span class="sipus-required">*</span></label>
                        <input type="text" id="isbn" name="isbn"
                               class="sipus-input @error('isbn') is-invalid @enderror"
                               value="{{ old('isbn', $buku->isbn) }}"
                               placeholder="Contoh: 978-602-1230-01-1">
                        @error('isbn')
                            <div class="sipus-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Kategori --}}
                    <div class="sipus-form-group">
                        <label for="kategori_id" class="sipus-label">Kategori Keilmuan <span class="sipus-required">*</span></label>
                        <select id="kategori_id" name="kategori_id"
                                class="sipus-select @error('kategori_id') is-invalid @enderror">
                            <option value="">— Pilih Kategori —</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}"
                                    {{ old('kategori_id', $buku->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->kode_kategori }} — {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <div class="sipus-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Judul Buku --}}
                    <div class="sipus-form-group sipus-form-group-full">
                        <label for="judul" class="sipus-label">Judul Buku / Skripsi <span class="sipus-required">*</span></label>
                        <input type="text" id="judul" name="judul"
                               class="sipus-input @error('judul') is-invalid @enderror"
                               value="{{ old('judul', $buku->judul) }}">
                        @error('judul')
                            <div class="sipus-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Penulis --}}
                    <div class="sipus-form-group">
                        <label for="penulis" class="sipus-label">Penulis / Mahasiswa Peneliti <span class="sipus-required">*</span></label>
                        <input type="text" id="penulis" name="penulis"
                               class="sipus-input @error('penulis') is-invalid @enderror"
                               value="{{ old('penulis', $buku->penulis) }}">
                        @error('penulis')
                            <div class="sipus-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Penerbit --}}
                    <div class="sipus-form-group">
                        <label for="penerbit" class="sipus-label">Penerbit / Institusi <span class="sipus-required">*</span></label>
                        <input type="text" id="penerbit" name="penerbit"
                               class="sipus-input @error('penerbit') is-invalid @enderror"
                               value="{{ old('penerbit', $buku->penerbit) }}">
                        @error('penerbit')
                            <div class="sipus-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tahun Terbit --}}
                    <div class="sipus-form-group">
                        <label for="tahun_terbit" class="sipus-label">Tahun Terbit <span class="sipus-required">*</span></label>
                        <input type="number" id="tahun_terbit" name="tahun_terbit"
                               class="sipus-input @error('tahun_terbit') is-invalid @enderror"
                               value="{{ old('tahun_terbit', $buku->tahun_terbit) }}"
                               min="1900" max="{{ date('Y') + 1 }}">
                        @error('tahun_terbit')
                            <div class="sipus-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Stok --}}
                    <div class="sipus-form-group">
                        <label for="stok" class="sipus-label">Jumlah Stok Eksemplar <span class="sipus-required">*</span></label>
                        <input type="number" id="stok" name="stok"
                               class="sipus-input @error('stok') is-invalid @enderror"
                               value="{{ old('stok', $buku->stok) }}"
                               min="0">
                        @error('stok')
                            <div class="sipus-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- ======================================================== --}}
                    {{-- 7.E. PENGELOLAAN LOKASI OLEH ADMIN (Jenis, Lantai, Rak) --}}
                    {{-- ======================================================== --}}
                    <div class="sipus-form-group sipus-form-group-full" style="background: #F8FAFC; border: 1px solid var(--sipus-border); border-radius: 8px; padding: 1.25rem; margin-top: 0.5rem;">
                        <h3 style="font-size: 0.95rem; font-weight: 700; color: var(--sipus-primary); margin: 0 0 0.85rem;">
                            Pengaturan Lokasi Koleksi di Perpustakaan
                        </h3>

                        <div class="sipus-form-grid">
                            {{-- Jenis Koleksi --}}
                            <div class="sipus-form-group">
                                <label for="jenis_koleksi" class="sipus-label">Jenis Koleksi <span class="sipus-required">*</span></label>
                                <select id="jenis_koleksi" name="jenis_koleksi"
                                        class="sipus-select @error('jenis_koleksi') is-invalid @enderror">
                                    <option value="Buku Pelajaran" {{ old('jenis_koleksi', $buku->jenis_koleksi) === 'Buku Pelajaran' ? 'selected' : '' }}>
                                        Buku Pelajaran (Lantai 1)
                                    </option>
                                    <option value="Skripsi" {{ old('jenis_koleksi', $buku->jenis_koleksi) === 'Skripsi' ? 'selected' : '' }}>
                                        Skripsi (Lantai 2)
                                    </option>
                                </select>
                                @error('jenis_koleksi')
                                    <div class="sipus-error">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Lantai --}}
                            <div class="sipus-form-group">
                                <label for="lantai" class="sipus-label">Lantai Perpustakaan <span class="sipus-required">*</span></label>
                                <select id="lantai" name="lantai"
                                        class="sipus-select @error('lantai') is-invalid @enderror">
                                    <option value="1" {{ old('lantai', $buku->lantai) == 1 ? 'selected' : '' }}>Lantai 1 — Buku Pelajaran</option>
                                    <option value="2" {{ old('lantai', $buku->lantai) == 2 ? 'selected' : '' }}>Lantai 2 — Skripsi &amp; TA</option>
                                </select>
                                <p class="sipus-hint" id="lantai_notice">Aturan: Buku Pelajaran berada di Lantai 1, Skripsi di Lantai 2.</p>
                                @error('lantai')
                                    <div class="sipus-error">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Kode Rak --}}
                            <div class="sipus-form-group sipus-form-group-full">
                                <label for="kode_rak" class="sipus-label">Kode / Nomor Rak Fisik</label>
                                <input type="text" id="kode_rak" name="kode_rak"
                                       class="sipus-input @error('kode_rak') is-invalid @enderror"
                                       value="{{ old('kode_rak', $buku->kode_rak) }}"
                                       placeholder="Contoh: A-01, B-03, SKR-TI-01">
                                <p class="sipus-hint">Perbarui posisi rak jika buku dipindahkan lokasi penyimpanannya</p>
                                @error('kode_rak')
                                    <div class="sipus-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Sinopsis --}}
                    <div class="sipus-form-group sipus-form-group-full">
                        <label for="sinopsis" class="sipus-label">Sinopsis / Abstrak <span class="sipus-optional">(opsional)</span></label>
                        <textarea id="sinopsis" name="sinopsis" rows="4"
                                  class="sipus-textarea @error('sinopsis') is-invalid @enderror">{{ old('sinopsis', $buku->sinopsis) }}</textarea>
                        @error('sinopsis')
                            <div class="sipus-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Form Actions --}}
                <div class="sipus-form-actions">
                    <a href="{{ route('buku.show', $buku) }}" class="sipus-btn sipus-btn-ghost">Batal</a>
                    <button type="submit" class="sipus-btn sipus-btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="16" height="16">
                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-layout>
