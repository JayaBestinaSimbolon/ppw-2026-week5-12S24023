<x-layout title="Layanan Pengajuan Cek Turnitin">

    <div class="sipus-container sipus-content-wrap">
        {{-- Banner Pengantar --}}
        <div class="sipus-turnitin-banner">
            <div style="display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 1.5rem;">
                <div>
                    <div style="display: inline-flex; align-items: center; gap: 0.4rem; background: rgba(255,255,255,0.15); padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.75rem;">
                        Integritas Akademik &middot; Institut Teknologi Del
                    </div>
                    <h2>Layanan Pemeriksaan Tingkat Kemiripan Dokumen (Turnitin)</h2>
                    <p>
                        Fasilitas pemeriksaan orisinalitas karya tulis ilmiah untuk mahasiswa Institut Teknologi Del. Dokumen yang diajukan akan diproses secara manual dan teliti oleh staf perpustakaan Del.
                    </p>
                </div>
                <div style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 1.25rem; font-size: 0.825rem; max-width: 320px;">
                    <div style="font-weight: 700; margin-bottom: 0.35rem; color: #ffffff;">Alur Pemrosesan:</div>
                    <ol style="margin: 0; padding-left: 1.25rem; line-height: 1.5; color: rgba(255,255,255,0.85);">
                        <li>Kirim formulir &amp; unggah berkas (PDF/Word).</li>
                        <li>Staf perpustakaan memverifikasi berkas.</li>
                        <li>Hasil laporan kemiripan dikirim ke email mahasiswa.</li>
                    </ol>
                </div>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1.3fr 1fr; gap: 2rem; align-items: start;">
            {{-- Form Pengajuan --}}
            <div class="sipus-card">
                <h3 style="font-size: 1.15rem; font-weight: 800; color: var(--sipus-primary); margin: 0 0 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="20" height="20">
                        <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                    </svg>
                    Formulir Pengajuan Dokumen
                </h3>
                <p style="font-size: 0.85rem; color: var(--sipus-text-muted); margin: 0 0 1.5rem;">
                    Pastikan informasi yang Anda masukkan valid sesuai data akademik Institut Teknologi Del.
                </p>

                <form action="{{ route('turnitin.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf

                    <div style="display: flex; flex-direction: column; gap: 1.15rem;">
                        {{-- Nama Mahasiswa --}}
                        <div class="sipus-form-group">
                            <label for="nama_mahasiswa" class="sipus-label">Nama Lengkap Mahasiswa <span class="sipus-required">*</span></label>
                            <input type="text" id="nama_mahasiswa" name="nama_mahasiswa"
                                   class="sipus-input @error('nama_mahasiswa') is-invalid @enderror"
                                   value="{{ old('nama_mahasiswa') }}"
                                   placeholder="Contoh: Samuel Christian Simanjuntak">
                            @error('nama_mahasiswa')
                                <div class="sipus-error">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- NIM & Email --}}
                        <div class="sipus-form-grid">
                            <div class="sipus-form-group">
                                <label for="nim" class="sipus-label">NIM Mahasiswa <span class="sipus-required">*</span></label>
                                <input type="text" id="nim" name="nim"
                                       class="sipus-input @error('nim') is-invalid @enderror"
                                       value="{{ old('nim') }}"
                                       placeholder="Contoh: 11S21001">
                                @error('nim')
                                    <div class="sipus-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="sipus-form-group">
                                <label for="email" class="sipus-label">Email Mahasiswa (Aktif) <span class="sipus-required">*</span></label>
                                <input type="email" id="email" name="email"
                                       class="sipus-input @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}"
                                       placeholder="nama@students.del.ac.id">
                                @error('email')
                                    <div class="sipus-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Judul Dokumen --}}
                        <div class="sipus-form-group">
                            <label for="judul_dokumen" class="sipus-label">Judul Dokumen / Karya Ilmiah <span class="sipus-required">*</span></label>
                            <input type="text" id="judul_dokumen" name="judul_dokumen"
                                   class="sipus-input @error('judul_dokumen') is-invalid @enderror"
                                   value="{{ old('judul_dokumen') }}"
                                   placeholder="Masukkan judul lengkap naskah Anda">
                            @error('judul_dokumen')
                                <div class="sipus-error">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Jenis Dokumen --}}
                        <div class="sipus-form-group">
                            <label for="jenis_dokumen" class="sipus-label">Jenis Dokumen <span class="sipus-required">*</span></label>
                            <select id="jenis_dokumen" name="jenis_dokumen"
                                    class="sipus-select @error('jenis_dokumen') is-invalid @enderror">
                                <option value="">— Pilih Jenis Dokumen —</option>
                                <option value="Laporan" {{ old('jenis_dokumen') === 'Laporan' ? 'selected' : '' }}>Laporan Praktikum / Proyek</option>
                                <option value="Makalah" {{ old('jenis_dokumen') === 'Makalah' ? 'selected' : '' }}>Makalah / Paper Seminar</option>
                                <option value="Proposal" {{ old('jenis_dokumen') === 'Proposal' ? 'selected' : '' }}>Proposal Tugas Akhir / Skripsi</option>
                                <option value="Tugas Akhir / Skripsi" {{ old('jenis_dokumen') === 'Tugas Akhir / Skripsi' ? 'selected' : '' }}>Tugas Akhir / Skripsi Lengkap</option>
                            </select>
                            @error('jenis_dokumen')
                                <div class="sipus-error">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Unggah Berkas --}}
                        <div class="sipus-form-group">
                            <label for="dokumen" class="sipus-label">Unggah Berkas Naskah <span class="sipus-required">*</span></label>
                            <input type="file" id="dokumen" name="dokumen"
                                   class="sipus-input @error('dokumen') is-invalid @enderror"
                                   accept=".pdf,.doc,.docx">
                            <p class="sipus-hint">Format diterima: <strong>PDF, DOC, DOCX</strong>. Maksimal ukuran berkas <strong>15 MB</strong>.</p>
                            @error('dokumen')
                                <div class="sipus-error">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Catatan Tambahan --}}
                        <div class="sipus-form-group">
                            <label for="catatan" class="sipus-label">Catatan Tambahan <span class="sipus-optional">(opsional)</span></label>
                            <textarea id="catatan" name="catatan" rows="3"
                                      class="sipus-textarea @error('catatan') is-invalid @enderror"
                                      placeholder="Contoh: Lampiran tidak perlu diperiksa, bagian bab 1 s.d. 5 saja...">{{ old('catatan') }}</textarea>
                            @error('catatan')
                                <div class="sipus-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div style="background: #F1F5F9; border-radius: 8px; padding: 0.85rem; font-size: 0.8rem; color: #475569; display: flex; align-items: flex-start; gap: 0.5rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="16" height="16" style="color: var(--sipus-primary); flex-shrink: 0; margin-top: 2px;">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                Dokumen Anda dilindungi di penyimpanan server privat dan tidak dipublikasikan ke repository umum sebelum proses kelulusan.
                            </div>
                        </div>

                        <div class="sipus-form-actions" style="margin-top: 0.5rem;">
                            <button type="submit" class="sipus-btn sipus-btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="16" height="16">
                                    <path d="M3.105 2.289a.75.75 0 00-.826.95l1.414 4.925A1.5 1.5 0 005.135 9.25h6.115a.75.75 0 010 1.5H5.135a1.5 1.5 0 00-1.442 1.086l-1.414 4.926a.75.75 0 00.826.95 28.896 28.896 0 0015.293-7.154.75.75 0 000-1.114A28.897 28.897 0 003.105 2.289z" />
                                </svg>
                                Kirim Pengajuan Pemeriksaan
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Kolom Kanan: Panduan & Pengajuan Terkini --}}
            <div>
                {{-- Ketentuan Pengajuan --}}
                <div class="sipus-card">
                    <h4 style="font-size: 0.95rem; font-weight: 700; color: var(--sipus-primary-dark); margin: 0 0 0.85rem;">
                        Ketentuan Pemeriksaan Dokumen
                    </h4>
                    <ul style="margin: 0; padding-left: 1.15rem; font-size: 0.825rem; color: var(--sipus-text); line-height: 1.7;">
                        <li>Dokumen yang diunggah harus naskah asli tulisan sendiri.</li>
                        <li>Format penulisan mengacu pada Panduan TA Institut Teknologi Del.</li>
                        <li>Waktu pemeriksaan berkisar antara <strong>1 – 2 hari kerja</strong>.</li>
                        <li>Hasil laporan kemiripan dalam format PDF akan dikirimkan langsung ke email mahasiswa terdaftar.</li>
                    </ul>
                </div>

                {{-- Status Pengajuan Terkini di Database MySQL --}}
                <div class="sipus-card">
                    <h4 style="font-size: 0.95rem; font-weight: 700; color: var(--sipus-primary-dark); margin: 0 0 0.85rem; display: flex; align-items: center; justify-content: space-between;">
                        <span>Daftar Pengajuan Terkini</span>
                        <span style="font-size: 0.75rem; font-weight: normal; color: var(--sipus-text-muted);">Database Real-time</span>
                    </h4>

                    @forelse ($submissions as $sub)
                        <div style="border-bottom: 1px solid var(--sipus-border-subtle); padding: 0.75rem 0;">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 0.5rem; margin-bottom: 0.25rem;">
                                <div style="font-weight: 700; font-size: 0.85rem; color: var(--sipus-text); line-height: 1.3;">
                                    {{ $sub->judul_dokumen }}
                                </div>
                                @if ($sub->status === 'Selesai')
                                    <span class="sipus-badge sipus-badge-green">Selesai</span>
                                @elseif ($sub->status === 'Diproses')
                                    <span class="sipus-badge sipus-badge-purple">Diproses</span>
                                @else
                                    <span class="sipus-badge sipus-badge-yellow">Menunggu</span>
                                @endif
                            </div>
                            <div style="font-size: 0.775rem; color: var(--sipus-text-muted);">
                                {{ $sub->nama_mahasiswa }} ({{ $sub->nim }}) &middot; {{ $sub->jenis_dokumen }} &middot; {{ $sub->created_at->diffForHumans() }}
                            </div>
                        </div>
                    @empty
                        <div style="padding: 1rem 0; text-align: center; font-size: 0.85rem; color: var(--sipus-text-muted);">
                            Belum ada riwayat pengajuan Turnitin di database.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</x-layout>
