<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bukus = [
            // Teknologi Informasi
            [
                'isbn'        => '978-602-1230-01-1',
                'judul'       => 'Pengantar Teknologi Informasi',
                'penulis'     => 'Dr. Ahmad Fauzi, M.Kom',
                'penerbit'    => 'Informatika',
                'tahun_terbit'=> 2020,
                'kategori'    => 'TI',
                'stok'        => 10,
                'sinopsis'    => 'Buku ini membahas konsep dasar teknologi informasi, perkembangan hardware dan software, serta penerapannya dalam berbagai bidang kehidupan modern.',
            ],
            [
                'isbn'        => '978-602-1230-02-8',
                'judul'       => 'Keamanan Informasi Digital',
                'penulis'     => 'Prof. Bambang Santoso, Ph.D',
                'penerbit'    => 'Andi Publisher',
                'tahun_terbit'=> 2021,
                'kategori'    => 'TI',
                'stok'        => 7,
                'sinopsis'    => 'Membahas ancaman keamanan informasi di era digital, teknik enkripsi, serta strategi perlindungan data pada organisasi modern.',
            ],
            [
                'isbn'        => '978-602-1230-03-5',
                'judul'       => 'Cloud Computing: Konsep dan Implementasi',
                'penulis'     => 'Siti Rahayu, S.Kom, M.T',
                'penerbit'    => 'Elex Media Komputindo',
                'tahun_terbit'=> 2022,
                'kategori'    => 'TI',
                'stok'        => 5,
                'sinopsis'    => 'Panduan lengkap memahami komputasi awan mulai dari konsep dasar, model layanan, hingga implementasi praktis menggunakan AWS dan Google Cloud.',
            ],
            // Pemrograman
            [
                'isbn'        => '978-602-1230-04-2',
                'judul'       => 'Pemrograman Web Modern dengan Laravel',
                'penulis'     => 'Rizky Pratama, S.T, M.T',
                'penerbit'    => 'Andi Publisher',
                'tahun_terbit'=> 2023,
                'kategori'    => 'PRG',
                'stok'        => 15,
                'sinopsis'    => 'Buku praktis pengembangan aplikasi web menggunakan framework Laravel, mencakup MVC, Eloquent ORM, Blade templating, dan deployment.',
            ],
            [
                'isbn'        => '978-602-1230-05-9',
                'judul'       => 'Algoritma dan Struktur Data',
                'penulis'     => 'Dr. Hendra Wijaya, M.Cs',
                'penerbit'    => 'Informatika',
                'tahun_terbit'=> 2019,
                'kategori'    => 'PRG',
                'stok'        => 8,
                'sinopsis'    => 'Pembahasan mendalam tentang algoritma pemrograman, berbagai struktur data seperti array, linked list, tree, dan graph beserta analisis kompleksitasnya.',
            ],
            [
                'isbn'        => '978-602-1230-06-6',
                'judul'       => 'Pemrograman Berorientasi Objek dengan Java',
                'penulis'     => 'Agus Setiawan, M.Kom',
                'penerbit'    => 'Erlangga',
                'tahun_terbit'=> 2021,
                'kategori'    => 'PRG',
                'stok'        => 12,
                'sinopsis'    => 'Panduan belajar OOP menggunakan bahasa Java, mencakup konsep class, inheritance, polymorphism, enkapsulasi, dan design pattern.',
            ],
            [
                'isbn'        => '978-602-1230-07-3',
                'judul'       => 'Python untuk Data Science dan Machine Learning',
                'penulis'     => 'Dewi Anggraini, Ph.D',
                'penerbit'    => 'Deepublish',
                'tahun_terbit'=> 2022,
                'kategori'    => 'PRG',
                'stok'        => 6,
                'sinopsis'    => 'Pembelajaran pemrograman Python terapan untuk data science, analisis data dengan Pandas, visualisasi dengan Matplotlib, dan machine learning dengan Scikit-learn.',
            ],
            // Basis Data
            [
                'isbn'        => '978-602-1230-08-0',
                'judul'       => 'Dasar-Dasar Basis Data Relasional',
                'penulis'     => 'Ir. Budi Hartono, M.Sc',
                'penerbit'    => 'Informatika',
                'tahun_terbit'=> 2018,
                'kategori'    => 'BD',
                'stok'        => 20,
                'sinopsis'    => 'Buku ini menjelaskan konsep basis data relasional, model entity-relationship, normalisasi, dan query SQL secara mendalam dengan contoh kasus nyata.',
            ],
            [
                'isbn'        => '978-602-1230-09-7',
                'judul'       => 'Sistem Manajemen Basis Data',
                'penulis'     => 'Dra. Linda Kusuma, M.Kom',
                'penerbit'    => 'Gramedia',
                'tahun_terbit'=> 2020,
                'kategori'    => 'BD',
                'stok'        => 9,
                'sinopsis'    => 'Membahas arsitektur DBMS, transaksi database, concurrency control, pemulihan data, serta administrasi database menggunakan MySQL dan PostgreSQL.',
            ],
            [
                'isbn'        => '978-602-1230-10-3',
                'judul'       => 'Desain Basis Data Lanjutan',
                'penulis'     => 'Eko Nugroho, M.Sc',
                'penerbit'    => 'Andi Publisher',
                'tahun_terbit'=> 2021,
                'kategori'    => 'BD',
                'stok'        => 4,
                'sinopsis'    => 'Pembahasan teknik desain basis data tingkat lanjut, mencakup data warehouse, OLAP, basis data terdistribusi, dan NoSQL untuk kebutuhan enterprise.',
            ],
            // Sistem Informasi
            [
                'isbn'        => '978-602-1230-11-0',
                'judul'       => 'Analisis dan Perancangan Sistem Informasi',
                'penulis'     => 'Dr. Ahmad Fauzi, M.Kom',
                'penerbit'    => 'Elex Media Komputindo',
                'tahun_terbit'=> 2019,
                'kategori'    => 'SI',
                'stok'        => 14,
                'sinopsis'    => 'Panduan lengkap analisis kebutuhan sistem, perancangan menggunakan UML, prototyping, serta manajemen proyek pengembangan sistem informasi.',
            ],
            [
                'isbn'        => '978-602-1230-12-7',
                'judul'       => 'Rekayasa Perangkat Lunak',
                'penulis'     => 'Prof. Bambang Santoso, Ph.D',
                'penerbit'    => 'Informatika',
                'tahun_terbit'=> 2020,
                'kategori'    => 'SI',
                'stok'        => 11,
                'sinopsis'    => 'Membahas metodologi pengembangan perangkat lunak, model SDLC, agile development, testing, dan quality assurance dalam pengembangan sistem informasi.',
            ],
            [
                'isbn'        => '978-602-1230-13-4',
                'judul'       => 'Enterprise Resource Planning',
                'penulis'     => 'Rizky Pratama, S.T, M.T',
                'penerbit'    => 'Deepublish',
                'tahun_terbit'=> 2022,
                'kategori'    => 'SI',
                'stok'        => 3,
                'sinopsis'    => 'Buku ini menjelaskan konsep ERP, implementasi SAP, manajemen perubahan organisasi dalam adopsi sistem ERP, serta studi kasus perusahaan di Indonesia.',
            ],
            // Manajemen
            [
                'isbn'        => '978-602-1230-14-1',
                'judul'       => 'Manajemen Proyek Teknologi Informasi',
                'penulis'     => 'Siti Rahayu, S.Kom, M.T',
                'penerbit'    => 'Gramedia',
                'tahun_terbit'=> 2021,
                'kategori'    => 'MNJ',
                'stok'        => 8,
                'sinopsis'    => 'Panduan praktis manajemen proyek IT menggunakan PMBOK, agile, dan PRINCE2, mencakup perencanaan, monitoring, risk management, dan pelaporan proyek.',
            ],
            [
                'isbn'        => '978-602-1230-15-8',
                'judul'       => 'Audit Sistem Informasi',
                'penulis'     => 'Eko Nugroho, M.Sc',
                'penerbit'    => 'Erlangga',
                'tahun_terbit'=> 2023,
                'kategori'    => 'MNJ',
                'stok'        => 6,
                'sinopsis'    => 'Membahas konsep dan prosedur audit sistem informasi, framework COBIT, kerangka pengendalian internal, dan tata kelola IT pada perusahaan modern.',
            ],
            // Jaringan Komputer
            [
                'isbn'        => '978-602-1230-16-5',
                'judul'       => 'Jaringan Komputer dan Keamanan Siber',
                'penulis'     => 'Dr. Hendra Wijaya, M.Cs',
                'penerbit'    => 'Andi Publisher',
                'tahun_terbit'=> 2022,
                'kategori'    => 'JK',
                'stok'        => 10,
                'sinopsis'    => 'Pembahasan menyeluruh tentang arsitektur jaringan komputer, protokol TCP/IP, keamanan jaringan, firewall, VPN, dan mitigasi ancaman siber modern.',
            ],
            [
                'isbn'        => '978-602-1230-17-2',
                'judul'       => 'Komunikasi Data dan Jaringan',
                'penulis'     => 'Agus Setiawan, M.Kom',
                'penerbit'    => 'Informatika',
                'tahun_terbit'=> 2020,
                'kategori'    => 'JK',
                'stok'        => 7,
                'sinopsis'    => 'Buku ini membahas dasar komunikasi data, transmisi sinyal, protokol jaringan, topologi jaringan, dan implementasi infrastruktur jaringan enterprise.',
            ],
            // Kecerdasan Buatan
            [
                'isbn'        => '978-602-1230-18-9',
                'judul'       => 'Kecerdasan Buatan: Teori dan Implementasi',
                'penulis'     => 'Dewi Anggraini, Ph.D',
                'penerbit'    => 'Deepublish',
                'tahun_terbit'=> 2023,
                'kategori'    => 'AI',
                'stok'        => 0,
                'sinopsis'    => 'Buku komprehensif tentang kecerdasan buatan, mencakup machine learning, deep learning, natural language processing, dan computer vision dengan implementasi praktis.',
            ],
            [
                'isbn'        => '978-602-1230-19-6',
                'judul'       => 'Deep Learning dengan TensorFlow dan PyTorch',
                'penulis'     => 'Ir. Budi Hartono, M.Sc',
                'penerbit'    => 'Elex Media Komputindo',
                'tahun_terbit'=> 2023,
                'kategori'    => 'AI',
                'stok'        => 2,
                'sinopsis'    => 'Panduan hands-on implementasi neural network, CNN, RNN, dan transformer menggunakan framework TensorFlow dan PyTorch dengan contoh kasus nyata.',
            ],
            [
                'isbn'        => '978-602-1230-20-2',
                'judul'       => 'Pengolahan Citra Digital',
                'penulis'     => 'Dra. Linda Kusuma, M.Kom',
                'penerbit'    => 'Erlangga',
                'tahun_terbit'=> 2021,
                'kategori'    => 'AI',
                'stok'        => 5,
                'sinopsis'    => 'Membahas teknik pengolahan citra digital, filtering, segmentasi, pengenalan pola, serta aplikasi computer vision menggunakan OpenCV dan Python.',
            ],
        ];

        foreach ($bukus as $data) {
            $kategori = Kategori::where('kode_kategori', $data['kategori'])->first();
            if ($kategori) {
                \App\Models\Buku::create([
                    'isbn'         => $data['isbn'],
                    'judul'        => $data['judul'],
                    'penulis'      => $data['penulis'],
                    'penerbit'     => $data['penerbit'],
                    'tahun_terbit' => $data['tahun_terbit'],
                    'kategori_id'  => $kategori->id,
                    'stok'         => $data['stok'],
                    'sinopsis'     => $data['sinopsis'],
                ]);
            }
        }
    }
}
