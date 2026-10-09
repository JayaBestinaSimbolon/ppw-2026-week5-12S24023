<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            ['kode_kategori' => 'TI',  'nama_kategori' => 'Teknologi Informasi'],
            ['kode_kategori' => 'PRG', 'nama_kategori' => 'Pemrograman'],
            ['kode_kategori' => 'BD',  'nama_kategori' => 'Basis Data'],
            ['kode_kategori' => 'SI',  'nama_kategori' => 'Sistem Informasi'],
            ['kode_kategori' => 'MNJ', 'nama_kategori' => 'Manajemen'],
            ['kode_kategori' => 'JK',  'nama_kategori' => 'Jaringan Komputer'],
            ['kode_kategori' => 'AI',  'nama_kategori' => 'Kecerdasan Buatan'],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }
    }
}
