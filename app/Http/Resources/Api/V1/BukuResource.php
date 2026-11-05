<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BukuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $stok = (int) $this->stok;
        $isAvailable = $stok > 0;

        $links = [
            'self' => [
                'href'   => url("/api/v1/bukus/{$this->id}"),
                'method' => 'GET',
            ],
            'update_full' => [
                'href'   => url("/api/v1/bukus/{$this->id}"),
                'method' => 'PUT',
            ],
            'update_partial' => [
                'href'   => url("/api/v1/bukus/{$this->id}"),
                'method' => 'PATCH',
            ],
            'delete' => [
                'href'   => url("/api/v1/bukus/{$this->id}"),
                'method' => 'DELETE',
            ],
        ];

        // HATEOAS Dinamis: Tautan peminjaman hanya muncul jika stok buku tersedia (> 0)
        if ($isAvailable) {
            $links['pinjam_buku'] = [
                'href'   => url("/api/v1/peminjamans"),
                'method' => 'POST',
            ];
        }

        return [
            'id'            => $this->id,
            'isbn'          => $this->isbn,
            'judul'         => $this->judul,
            'penulis'       => $this->penulis,
            'penerbit'      => $this->penerbit,
            'tahun_terbit'  => $this->tahun_terbit,
            'jenis_koleksi' => $this->jenis_koleksi,
            'lantai'        => $this->lantai,
            'kode_rak'      => $this->kode_rak,
            'stok'          => $stok,
            'status_stok'   => $isAvailable ? 'TERSEDIA' : 'HABIS',
            'sinopsis'      => $this->sinopsis,
            'kategori'      => [
                'id'            => $this->kategori?->id,
                'kode_kategori' => $this->kategori?->kode_kategori,
                'nama_kategori' => $this->kategori?->nama_kategori,
            ],
            'updated_at'    => $this->updated_at?->toIso8601String(),
            'links'         => $links,
        ];
    }
}