<x-layout title="Beranda — Perpustakaan Institut Teknologi Del">
    <!-- HERO SECTION & PENCARIAN KATALOG -->
    <div style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); color: white; padding: 4rem 1rem 6rem 1rem; border-radius: 0 0 2.5rem 2.5rem; text-align: center;">
        <div style="max-width: 900px; margin: 0 auto; display: flex; flex-direction: column; align-items: center; justify-content: center;">
            <span style="background: white; color: #4f46e5; padding: 0.5rem 1rem; border-radius: 50rem; font-weight: 600; font-size: 0.85rem; margin-bottom: 1rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <i class="fas fa-university me-1"></i> Perpustakaan Akademik Institut Teknologi Del
            </span>
            <h1 style="font-size: 2.5rem; font-weight: bold; margin-bottom: 1rem; color: white;">Temukan Pengetahuan, Bangun Masa Depan</h1>
            <p style="font-size: 1.05rem; color: rgba(255,255,255,0.85); max-width: 750px; margin-bottom: 2rem; line-height: 1.6;">
                Jelajahi koleksi buku dan manfaatkan sistem perpustakaan terpadu Institut Teknologi Del untuk mendukung kegiatan belajar, penelitian, dan pengembangan pengetahuan.
            </p>
            
            <!-- Form Pencarian Katalog -->
            <form action="{{ route('katalog') }}" method="GET" style="width: 100%; max-width: 700px; display: flex; background: white; border-radius: 50rem; padding: 0.35rem; box-shadow: 0 10px 25px rgba(0,0,0,0.15);">
                <div style="display: flex; align-items: center; flex: 1; padding-left: 1rem;">
                    <i class="fas fa-search" style="color: #4f46e5; margin-right: 0.75rem;"></i>
                    <input type="text" name="q" placeholder="Cari judul buku, penulis, ISBN, atau kategori..." value="{{ request('q') }}" style="border: none; outline: none; width: 100%; font-size: 0.95rem; background: transparent;">
                </div>
                <button type="submit" style="background: #111827; color: white; border: none; padding: 0.75rem 2rem; border-radius: 50rem; font-weight: 600; cursor: pointer;">Cari Buku</button>
            </form>
        </div>
    </div>

    <!-- KONTEN UTAMA BERANDA -->
    <div class="container" style="max-width: 1140px; margin: -3rem auto 3rem auto; padding: 0 1rem; position: relative; z-index: 10;">
        <!-- STATISTIK SISTEM PERPUSTAKAAN (Sejajar Menyamping & Ada Ikon di Kiri) -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem; margin-bottom: 3rem;">
            <!-- Kartu 1 -->
            <div style="background: white; padding: 1.5rem; border-radius: 1rem; box-shadow: 0 10px 25px rgba(0,0,0,0.06); display: flex; align-items: center; gap: 1rem;">
                <div style="background: #ede9fe; color: #7c3aed; width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0;">
                    <i class="fas fa-book"></i>
                </div>
                <div>
                    <div style="font-size: 1.75rem; font-weight: bold; color: #111827; line-height: 1.2;">{{ isset($totalBuku) ? $totalBuku : 0 }}</div>
                    <div style="font-size: 0.8rem; color: #6b7280; font-weight: 600; text-transform: uppercase;">Total Judul Koleksi</div>
                </div>
            </div>
            <!-- Kartu 2 -->
            <div style="background: white; padding: 1.5rem; border-radius: 1rem; box-shadow: 0 10px 25px rgba(0,0,0,0.06); display: flex; align-items: center; gap: 1rem;">
                <div style="background: #d1fae5; color: #059669; width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0;">
                    <i class="fas fa-boxes"></i>
                </div>
                <div>
                    <div style="font-size: 1.75rem; font-weight: bold; color: #111827; line-height: 1.2;">{{ isset($totalStok) ? $totalStok : 0 }}</div>
                    <div style="font-size: 0.8rem; color: #6b7280; font-weight: 600; text-transform: uppercase;">Stok Eksemplar Tersedia</div>
                </div>
            </div>
            <!-- Kartu 3 -->
            <div style="background: white; padding: 1.5rem; border-radius: 1rem; box-shadow: 0 10px 25px rgba(0,0,0,0.06); display: flex; align-items: center; gap: 1rem;">
                <div style="background: #fef3c7; color: #d97706; width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0;">
                    <i class="fas fa-exchange-alt"></i>
                </div>
                <div>
                    <div style="font-size: 1.75rem; font-weight: bold; color: #111827; line-height: 1.2;">{{ isset($bukuDipinjam) ? $bukuDipinjam : 0 }}</div>
                    <div style="font-size: 0.8rem; color: #6b7280; font-weight: 600; text-transform: uppercase;">Buku Sedang Dipinjam</div>
                </div>
            </div>
            <!-- Kartu 4 -->
            <div style="background: white; padding: 1.5rem; border-radius: 1rem; box-shadow: 0 10px 25px rgba(0,0,0,0.06); display: flex; align-items: center; gap: 1rem;">
                <div style="background: #e0f2fe; color: #0284c7; width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0;">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div>
                    <div style="font-size: 1.75rem; font-weight: bold; color: #111827; line-height: 1.2;">{{ isset($totalDikembalikan) ? $totalDikembalikan : 0 }}</div>
                    <div style="font-size: 0.8rem; color: #6b7280; font-weight: 600; text-transform: uppercase;">Total Dikembalikan</div>
                </div>
            </div>
        </div>

        <!-- KLASIFIKASI KATEGORI BUKU -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.5rem;">
            <div>
                <span style="font-size: 0.75rem; text-transform: uppercase; color: #4f46e5; font-weight: bold; letter-spacing: 0.05em;">Klasifikasi Keilmuan</span>
                <h3 style="font-size: 1.5rem; font-weight: bold; color: #111827; margin: 0;">Kategori Buku</h3>
            </div>
            <a href="{{ route('kategori.index') }}" style="color: #4f46e5; font-weight: 600; text-decoration: none;">Lihat Semua Kategori →</a>
        </div>

        <div class="row g-4 mb-5">
            @forelse($kategoris ?? [] as $kategori)
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 p-4 bg-light">
                        <div class="card-body d-flex flex-column">
                            <h4 class="fw-bold text-dark fs-5 mb-2">{{ $kategori->nama_kategori }}</h4>
                            <p class="text-muted small mb-4">{{ Str::limit($kategori->deskripsi ?? 'Koleksi literatur dan referensi bidang ilmu.', 80) }}</p>
                            <div class="mt-auto">
                                <a href="{{ route('kategori.show', $kategori->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-semibold">Jelajahi Kategori</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-light border text-center py-4 text-muted rounded-4">
                        <p class="mb-0 text-muted">Belum ada kategori buku terdaftar di database.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- BUKU PILIHAN & TERBARU -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.5rem;">
            <div>
                <span style="font-size: 0.75rem; text-transform: uppercase; color: #4f46e5; font-weight: bold; letter-spacing: 0.05em;">Koleksi Terkini</span>
                <h3 style="font-size: 1.5rem; font-weight: bold; color: #111827; margin: 0;">Buku Pilihan & Terbaru</h3>
            </div>
            <a href="{{ route('katalog') }}" style="color: #4f46e5; font-weight: 600; text-decoration: none;">Lihat Semua Buku di Katalog →</a>
        </div>

        <div class="row g-4 mb-5">
            @forelse($bukus ?? [] as $buku)
                <div class="col-md-3">
                    <div class="card h-100 border-0 shadow-sm rounded-4 p-3 bg-white">
                        <div class="text-center py-4 bg-light rounded-3 mb-3">
                            <i class="fas fa-book-open fa-2x text-primary opacity-75"></i>
                        </div>
                        <div class="card-body d-flex flex-column p-0">
                            <span class="badge bg-primary bg-opacity-10 text-primary mb-2 align-self-start">{{ $buku->kategori->nama_kategori ?? 'Umum' }}</span>
                            <h5 class="fw-bold text-dark fs-6 mb-1 text-truncate">{{ $buku->judul }}</h5>
                            <p class="text-muted small mb-3">Oleh: {{ $buku->penulis }}</p>
                            <div class="mt-auto">
                                <a href="{{ route('buku.show', $buku->id) }}" class="btn btn-sm btn-dark w-100 rounded-pill fw-semibold">Detail Buku</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-light border text-center py-5 text-muted rounded-4">
                        <h5 class="fw-semibold text-dark">Belum Ada Koleksi Buku</h5>
                        <p class="mb-3 small text-muted">Silakan tambahkan data buku melalui menu pengelolaan atau panel pustakawan.</p>
                        <a href="{{ route('login') }}" class="btn btn-sm btn-primary px-4 rounded-pill fw-semibold">Login Pustakawan</a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>