<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'bukus';

    protected $fillable = [
        'isbn',
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'kategori_id',
        'jenis_koleksi',
        'lantai',
        'kode_rak',
        'stok',
        'sinopsis',
    ];

    /**
     * Scope untuk filter query buku.
     */
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['q'] ?? false, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                  ->orWhere('penulis', 'like', '%' . $search . '%')
                  ->orWhere('isbn', 'like', '%' . $search . '%')
                  ->orWhereHas('kategori', function ($qk) use ($search) {
                      $qk->where('nama_kategori', 'like', '%' . $search . '%');
                  });
            });
        });

        $query->when($filters['kategori'] ?? false, function ($query, $kategoriId) {
            $query->where('kategori_id', $kategoriId);
        });

        $query->when($filters['jenis_koleksi'] ?? false, function ($query, $jenis) {
            $query->where('jenis_koleksi', $jenis);
        });

        $query->when($filters['lantai'] ?? false, function ($query, $lantai) {
            $query->where('lantai', $lantai);
        });

        $query->when(isset($filters['ketersediaan']) && $filters['ketersediaan'] !== '', function ($query) use ($filters) {
            if ($filters['ketersediaan'] === 'tersedia') {
                $query->where('stok', '>', 0);
            } elseif ($filters['ketersediaan'] === 'habis') {
                $query->where('stok', '<=', 0);
            }
        });
    }

    /**
     * Relasi: Buku memiliki satu Kategori.
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    /**
     * Relasi: Buku memiliki banyak Peminjaman.
     */
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
