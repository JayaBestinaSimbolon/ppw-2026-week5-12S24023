<x-layout title="Bantuan & Panduan Perpustakaan">

    <div class="sipus-container sipus-content-wrap">
        <div class="sipus-page-header">
            <div>
                <h1 class="sipus-page-title">Pusat Bantuan &amp; Panduan</h1>
                <p class="sipus-page-subtitle">Panduan penggunaan SIPUS-Del, pencarian lokasi rak buku, dan pengajuan Turnitin</p>
            </div>
            <a href="{{ route('layanan.index') }}" class="sipus-btn sipus-btn-outline">
                &larr; Kembali ke Layanan
            </a>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            {{-- Panduan 1: Mencari Lokasi Lantai & Rak --}}
            <div class="sipus-card">
                <h3 style="font-size: 1.1rem; font-weight: 700; color: var(--sipus-primary); margin: 0 0 0.75rem; display: flex; align-items: center; gap: 0.5rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="20" height="20">
                        <path fill-rule="evenodd" d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 103 9c0 3.492 1.698 5.988 3.355 7.588a13.08 13.08 0 003.031 2.198l.018.008.006.003.002.001.001.001zM10 12a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                    </svg>
                    Cara Menemukan Buku Fisik di Perpustakaan
                </h3>
                <ol style="margin: 0; padding-left: 1.25rem; font-size: 0.875rem; color: var(--sipus-text); line-height: 1.7;">
                    <li>Buka menu <strong>Katalog Buku</strong> di SIPUS-Del.</li>
                    <li>Gunakan kotak pencarian atau filter kategori/lantai.</li>
                    <li>Perhatikan kolom <strong>Lokasi</strong>:
                        <ul style="margin: 0.25rem 0; padding-left: 1rem;">
                            <li><strong>Lantai 1:</strong> Seluruh Buku Pelajaran &amp; Teks Kuliah.</li>
                            <li><strong>Lantai 2:</strong> Seluruh Koleksi Naskah Skripsi &amp; Tugas Akhir.</li>
                        </ul>
                    </li>
                    <li>Catat <strong>Nomor Rak</strong> (misal: A-01, B-02, SKR-TI-01).</li>
                    <li>Kunjungi gedung perpustakaan dan langsung menuju lantai serta rak yang sesuai.</li>
                </ol>
            </div>

            {{-- Panduan 2: Cek Turnitin --}}
            <div class="sipus-card">
                <h3 style="font-size: 1.1rem; font-weight: 700; color: var(--sipus-primary); margin: 0 0 0.75rem; display: flex; align-items: center; gap: 0.5rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="20" height="20">
                        <path fill-rule="evenodd" d="M5.625 1.5H9a3.75 3.75 0 013.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 013.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 01-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875zm6.905 9.97a.75.75 0 00-1.06 0l-3 3a.75.75 0 101.06 1.06l1.72-1.72V18a.75.75 0 001.5 0v-4.19l1.72 1.72a.75.75 0 101.06-1.06l-3-3z" clip-rule="evenodd" />
                    </svg>
                    Prosedur Pengajuan Cek Turnitin
                </h3>
                <ol style="margin: 0; padding-left: 1.25rem; font-size: 0.875rem; color: var(--sipus-text); line-height: 1.7;">
                    <li>Buka menu <strong>Layanan &rsaquo; Cek Turnitin</strong>.</li>
                    <li>Isi data nama lengkap, NIM, dan email aktif mahasiswa.</li>
                    <li>Unggah naskah dalam format berkas <strong>.pdf, .doc, atau .docx</strong> (maks. 15MB).</li>
                    <li>Klik <strong>Kirim Pengajuan</strong> dan tunggu pesan berhasil.</li>
                    <li>Staf perpustakaan akan memproses dokumen dan mengirimkan file laporan kemiripan ke email Anda.</li>
                </ol>
            </div>

            {{-- Jam Operasional & Kontak --}}
            <div class="sipus-card" style="grid-column: 1 / -1;">
                <h3 style="font-size: 1.1rem; font-weight: 700; color: var(--sipus-primary); margin: 0 0 0.75rem;">
                    Jam Layanan &amp; Meja Informasi Pustakawan
                </h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem; font-size: 0.875rem;">
                    <div style="background: #F8FAFC; padding: 1rem; border-radius: 8px;">
                        <div style="font-weight: 700; color: var(--sipus-text);">Senin – Jumat</div>
                        <div style="color: var(--sipus-text-muted);">08.00 – 17.00 WIB (Layanan Penuh)</div>
                    </div>
                    <div style="background: #F8FAFC; padding: 1rem; border-radius: 8px;">
                        <div style="font-weight: 700; color: var(--sipus-text);">Sabtu – Minggu &amp; Libur Nasional</div>
                        <div style="color: var(--sipus-text-muted);">Tutup (Katalog Online 24 Jam)</div>
                    </div>
                    <div style="background: #F8FAFC; padding: 1rem; border-radius: 8px;">
                        <div style="font-weight: 700; color: var(--sipus-text);">Lokasi Gedung</div>
                        <div style="color: var(--sipus-text-muted);">Kampus IT Del, Laguboti, Toba</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>
