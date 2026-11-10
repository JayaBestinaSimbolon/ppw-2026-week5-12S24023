<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PeminjamanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // 1. Siapkan tautan standar (self)
        $links = [
            'self' => [
                'href' => url("/api/v1/peminjamans/{$this->id}"),
                'method' => 'GET',
            ],
        ];

        // 2. Logika HATEOAS: Tautan kembalikan_buku HANYA muncul jika status === 'dipinjam'
        if ($this->status === 'dipinjam') {
            $links['kembalikan_buku'] = [
                'href' => url("/api/v1/peminjamans/{$this->id}/kembalikan"),
                'method' => 'PATCH',
            ];
        }

        // 3. Susun bentuk akhir JSON yang akan dikembalikan ke pengguna
        return [
            'id' => $this->id,
            'buku_id' => $this->buku_id,
            'nim_peminjam' => $this->nim_peminjam,
            'nama_peminjam' => $this->nama_peminjam,
            'durasi_hari' => (int) $this->durasi_hari,
            'tanggal_pinjam' => $this->tanggal_pinjam,
            'tanggal_kembali' => $this->tanggal_kembali,
            'status' => $this->status,
            
            // Relasi ke detail buku (jika dipanggil menggunakan with('buku') di Controller)
            'buku' => new BukuResource($this->whenLoaded('buku')),
            
            '_links' => $links,
        ];
    }
}