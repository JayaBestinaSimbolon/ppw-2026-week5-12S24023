<?php

namespace Database\Factories;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kategori>
 */
class KategoriFactory extends Factory
{
    protected $model = Kategori::class;

    protected static array $kategoris = [
        ['kode' => 'TI', 'nama' => 'Teknologi Informasi'],
        ['kode' => 'PRG', 'nama' => 'Pemrograman'],
        ['kode' => 'BD', 'nama' => 'Basis Data'],
        ['kode' => 'SI', 'nama' => 'Sistem Informasi'],
        ['kode' => 'MNJ', 'nama' => 'Manajemen'],
        ['kode' => 'JK', 'nama' => 'Jaringan Komputer'],
        ['kode' => 'AI', 'nama' => 'Kecerdasan Buatan'],
        ['kode' => 'MTK', 'nama' => 'Matematika Komputasi'],
    ];

    protected static int $index = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $item = self::$kategoris[self::$index % count(self::$kategoris)];
        self::$index++;

        return [
            'kode_kategori' => $item['kode'],
            'nama_kategori' => $item['nama'],
        ];
    }
}
