<x-layout title="Layanan Perpustakaan Del">

    <div class="sipus-container sipus-content-wrap">
        <div class="sipus-page-header">
            <div>
                <h1 class="sipus-page-title">Direktori Layanan Perpustakaan</h1>
                <p class="sipus-page-subtitle">Pusat fasilitas akademik terpadu bagi mahasiswa, dosen, dan staf Institut Teknologi Del</p>
            </div>
            <a href="{{ route('katalog') }}" class="sipus-btn sipus-btn-primary">
                Katalog Buku
            </a>
        </div>

        <div class="sipus-services-grid" style="margin-bottom: 3rem;">
            {{-- Kartu 1: Turnitin --}}
            <div class="sipus-service-card">
                <div class="sipus-service-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="28" height="28">
                        <path fill-rule="evenodd" d="M5.625 1.5H9a3.75 3.75 0 013.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 013.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 01-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875zm6.905 9.97a.75.75 0 00-1.06 0l-3 3a.75.75 0 101.06 1.06l1.72-1.72V18a.75.75 0 001.5 0v-4.19l1.72 1.72a.75.75 0 101.06-1.06l-3-3z" clip-rule="evenodd" />
                    </svg>
                </div>
                <h3 class="sipus-service-title">Cek Turnitin</h3>
                <p class="sipus-service-desc">
                    Ajukan pemeriksaan tingkat kemiripan dokumen akademik untuk membantu mengevaluasi orisinalitas karya tulis.
                </p>
                <a href="{{ route('turnitin.index') }}" class="sipus-service-btn">
                    Ajukan Pemeriksaan &rarr;
                </a>
            </div>

            {{-- Kartu 2: Katalog --}}
            <div class="sipus-service-card">
                <div class="sipus-service-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="28" height="28">
                        <path d="M8.25 10.875a2.625 2.625 0 115.25 0 2.625 2.625 0 01-5.25 0z" />
                        <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.125 4.5a4.125 4.125 0 102.338 7.524l2.007 2.006a.75.75 0 101.06-1.06l-2.006-2.007A4.125 4.125 0 0010.875 6.75z" clip-rule="evenodd" />
                    </svg>
                </div>
                <h3 class="sipus-service-title">Pencarian Katalog Buku</h3>
                <p class="sipus-service-desc">
                    Temukan referensi berdasarkan judul, penulis, ISBN, atau kategori buku.
                </p>
                <a href="{{ route('katalog') }}" class="sipus-service-btn">
                    Cari Buku &rarr;
                </a>
            </div>

            {{-- Kartu 3: Ketersediaan & Lokasi Rak --}}
            <div class="sipus-service-card">
                <div class="sipus-service-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="28" height="28">
                        <path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                    </svg>
                </div>
                <h3 class="sipus-service-title">Informasi Ketersediaan Buku</h3>
                <p class="sipus-service-desc">
                    Periksa koleksi, stok, serta lokasi lantai dan rak buku yang ingin ditemukan.
                </p>
                <a href="{{ route('katalog') }}" class="sipus-service-btn">
                    Lihat Koleksi &rarr;
                </a>
            </div>

            {{-- Kartu 4: Bantuan --}}
            <div class="sipus-service-card">
                <div class="sipus-service-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="28" height="28">
                        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm11.378-3.917c-.076-.656-.582-1.161-1.24-1.238a41.488 41.488 0 00-5.276 0c-.658.077-1.164.582-1.24 1.238a41.516 41.516 0 000 7.834c.076.656.582 1.161 1.24 1.238a41.488 41.488 0 005.276 0c.658-.077 1.164-.582 1.24-1.238a41.516 41.516 0 000-7.834zM9.75 9.75a.75.75 0 000 1.5h.008a.75.75 0 000-1.5H9.75zm0 3a.75.75 0 000 1.5h4.5a.75.75 0 000-1.5h-4.5z" clip-rule="evenodd" />
                    </svg>
                </div>
                <h3 class="sipus-service-title">Bantuan Perpustakaan</h3>
                <p class="sipus-service-desc">
                    Dapatkan informasi mengenai penggunaan katalog dan layanan perpustakaan.
                </p>
                <a href="{{ route('layanan.bantuan') }}" class="sipus-service-btn">
                    Lihat Bantuan &rarr;
                </a>
            </div>
        </div>

        {{-- Panduan Tata Letak Gedung Perpustakaan Del --}}
        <div class="sipus-card">
            <h2 style="font-size: 1.25rem; font-weight: 800; color: var(--sipus-primary-dark); margin: 0 0 1rem;">
                Struktur Zonasi Lantai Perpustakaan Institut Teknologi Del
            </h2>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div style="background: #F8FAFC; border: 1px solid var(--sipus-border); border-radius: 8px; padding: 1.25rem;">
                    <span class="sipus-badge sipus-badge-purple" style="margin-bottom: 0.5rem;">Lantai 1</span>
                    <h3 style="font-size: 1.1rem; font-weight: 700; margin: 0.25rem 0 0.5rem; color: var(--sipus-text);">
                        Zona Koleksi Buku Pelajaran &amp; Referensi Kuliah
                    </h3>
                    <p style="font-size: 0.85rem; color: var(--sipus-text-muted); line-height: 1.6; margin: 0 0 1rem;">
                        Menyimpan buku teks perkuliahan, buku pengantar keilmuan TI, pemrograman, basis data, dan referensi akademik umum. Setiap buku tersusun rapi pada rak berkode (misal: A-01, B-02, C-01).
                    </p>
                    <a href="{{ route('katalog', ['lantai' => 1]) }}" class="sipus-btn-sm sipus-btn-sm-info">
                        Jelajahi Koleksi Lantai 1 &rarr;
                    </a>
                </div>

                <div style="background: #F8FAFC; border: 1px solid var(--sipus-border); border-radius: 8px; padding: 1.25rem;">
                    <span class="sipus-badge sipus-badge-purple" style="margin-bottom: 0.5rem;">Lantai 2</span>
                    <h3 style="font-size: 1.1rem; font-weight: 700; margin: 0.25rem 0 0.5rem; color: var(--sipus-text);">
                        Zona Koleksi Skripsi &amp; Tugas Akhir Mahasiswa
                    </h3>
                    <p style="font-size: 0.85rem; color: var(--sipus-text-muted); line-height: 1.6; margin: 0 0 1rem;">
                        Menyimpan arsip fisik naskah skripsi dan proyek akhir mahasiswa Institut Teknologi Del dari berbagai program studi. Disusun pada rak khusus berkode (misal: SKR-TI-01, SKR-PRG-01).
                    </p>
                    <a href="{{ route('katalog', ['lantai' => 2]) }}" class="sipus-btn-sm sipus-btn-sm-info">
                        Jelajahi Koleksi Lantai 2 &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>

</x-layout>
