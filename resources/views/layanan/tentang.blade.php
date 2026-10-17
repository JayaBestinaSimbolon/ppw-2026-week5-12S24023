<x-layout title="Tentang SIPUS-Del">

    <div class="sipus-container sipus-content-wrap">
        <div class="sipus-page-header">
            <div>
                <h1 class="sipus-page-title">Tentang SIPUS-Del</h1>
                <p class="sipus-page-subtitle">Sistem Informasi Perpustakaan Institut Teknologi Del</p>
            </div>
            <a href="{{ route('dashboard') }}" class="sipus-btn sipus-btn-outline">
                &larr; Kembali ke Beranda
            </a>
        </div>

        <div class="sipus-card" style="margin-bottom: 2rem;">
            <div style="display: flex; gap: 1.5rem; align-items: flex-start; flex-wrap: wrap;">
                <div class="sipus-brand-icon" style="width: 64px; height: 64px; border-radius: 16px;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="36" height="36">
                        <path d="M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 20.636A8.214 8.214 0 0118 18.75c.966 0 1.89.166 2.75.47a.75.75 0 001-.708V4.262a.75.75 0 00-.5-.707A9.735 9.735 0 0018 3a9.707 9.707 0 00-5.25 1.533v16.103z" />
                    </svg>
                </div>
                <div style="flex: 1;">
                    <h2 style="font-size: 1.4rem; font-weight: 800; color: var(--sipus-primary-dark); margin: 0 0 0.5rem;">
                        Visi &amp; Misi SIPUS-Del
                    </h2>
                    <p style="font-size: 0.95rem; color: var(--sipus-text); line-height: 1.7; margin: 0 0 1rem;">
                        <strong>SIPUS-Del</strong> merupakan sistem informasi perpustakaan yang dikembangkan untuk memfasilitasi sivitas akademika Institut Teknologi Del dalam menelusuri koleksi pustaka, memverifikasi ketersediaan stok buku secara <em>real-time</em>, serta memandu pencarian fisik melalui informasi nomor lantai dan kode rak penyimpanan.
                    </p>
                    <p style="font-size: 0.95rem; color: var(--sipus-text); line-height: 1.7; margin: 0;">
                        Melalui platform ini, mahasiswa tidak perlu lagi menebak letak buku pelajaran atau naskah skripsi saat datang ke gedung perpustakaan, sehingga efisiensi waktu studi dan penelitian dapat tercapai secara optimal.
                    </p>
                </div>
            </div>
        </div>

        {{-- Pilar Layanan --}}
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
            <div class="sipus-card">
                <h3 style="font-size: 1.05rem; font-weight: 700; color: var(--sipus-primary); margin: 0 0 0.5rem;">
                    Zonasi Dua Lantai
                </h3>
                <p style="font-size: 0.85rem; color: var(--sipus-text-muted); line-height: 1.6; margin: 0;">
                    Tata letak terstandarisasi dengan <strong>Lantai 1</strong> untuk Buku Pelajaran/Mata Kuliah dan <strong>Lantai 2</strong> untuk Koleksi Skripsi/Tugas Akhir.
                </p>
            </div>

            <div class="sipus-card">
                <h3 style="font-size: 1.05rem; font-weight: 700; color: var(--sipus-primary); margin: 0 0 0.5rem;">
                    Akurasi Kode Rak
                </h3>
                <p style="font-size: 0.85rem; color: var(--sipus-text-muted); line-height: 1.6; margin: 0;">
                    Setiap judul buku memiliki kode rak fisik yang dapat diperbarui pustakawan dan langsung terintegrasi dengan basis data MySQL.
                </p>
            </div>

            <div class="sipus-card">
                <h3 style="font-size: 1.05rem; font-weight: 700; color: var(--sipus-primary); margin: 0 0 0.5rem;">
                    Integritas Turnitin
                </h3>
                <p style="font-size: 0.85rem; color: var(--sipus-text-muted); line-height: 1.6; margin: 0;">
                    Alur pengajuan uji kemiripan dokumen secara terstruktur untuk menjamin orisinalitas karya akademik mahasiswa Institut Teknologi Del.
                </p>
            </div>
        </div>
    </div>

</x-layout>
