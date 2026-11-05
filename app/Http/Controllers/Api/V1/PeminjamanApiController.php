<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PeminjamanApiController extends Controller
{
    use ApiResponse;

    /**
     * GET /api/v1/peminjamans
     * Menampilkan daftar transaksi peminjaman (Wajib Bearer Token)
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = min(max((int) $request->query('per_page', 5), 1), 50);

        $paginator = Peminjaman::query()
            ->with('buku')
            ->when($request->query('status'), fn ($q, $status) => $q->where('status', $status))
            ->when($request->query('nim'), fn ($q, $nim) => $q->where('nim_peminjam', 'like', "%{$nim}%"))
            ->orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->withQueryString();

        return $this->successResponse(
            data: $paginator->items(),
            message: 'Daftar transaksi peminjaman berhasil diambil.',
            meta: [
                'current_page' => $paginator->currentPage(),
                'per_page'     => $paginator->perPage(),
                'total_items'  => $paginator->total(),
                'total_pages'  => $paginator->lastPage(),
            ]
        );
    }

    /**
     * POST /api/v1/peminjamans
     * Mencatat peminjaman buku baru dengan transaksi ACID + Pessimistic Locking
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'buku_id'       => 'required|exists:bukus,id',
            'nim_peminjam'  => 'required|string|max:20',
            'nama_peminjam' => 'required|string|max:150',
            'durasi_hari'   => 'nullable|integer|min:1|max:30',
        ]);

        return DB::transaction(function () use ($validated) {
            // 1. Kunci baris buku secara eksklusif (Race Condition Prevention)
            $buku = Buku::where('id', $validated['buku_id'])->lockForUpdate()->first();

            if (!$buku || $buku->stok < 1) {
                return $this->problemResponse(
                    title: 'Stock Exhausted',
                    detail: 'Maaf, stok buku yang diminta sedang habis.',
                    status: 422,
                    errorSlug: 'stok-habis'
                );
            }

            // 2. Cek apakah mahasiswa masih meminjam buku yang sama & belum dikembalikan (409 Conflict)
            $activeLoanExists = Peminjaman::where('buku_id', $buku->id)
                ->where('nim_peminjam', strtoupper(trim($validated['nim_peminjam'])))
                ->where('status', 'dipinjam')
                ->exists();

            if ($activeLoanExists) {
                return $this->problemResponse(
                    title: 'Duplicate Active Loan Conflict',
                    detail: 'Mahasiswa dengan NIM tersebut masih memiliki peminjaman aktif untuk buku ini.',
                    status: 409,
                    errorSlug: 'duplikasi-peminjaman'
                );
            }

            // 3. Kurangi stok buku (-1) dan catat transaksi peminjaman secara atomik
            $buku->decrement('stok');

            $durasi = $validated['durasi_hari'] ?? 7;
            $peminjaman = Peminjaman::create([
                'kode_pinjam'         => 'PMJ-' . date('Ymd') . '-' . strtoupper(Str::random(4)),
                'buku_id'             => $buku->id,
                'nim_peminjam'        => strtoupper(trim($validated['nim_peminjam'])),
                'nama_peminjam'       => $validated['nama_peminjam'],
                'tanggal_pinjam'      => now()->toDateString(),
                'tanggal_jatuh_tempo' => now()->addDays($durasi)->toDateString(),
                'status'              => 'dipinjam',
            ]);

            $peminjaman->load('buku');

            return $this->createdResponse(
                data: $peminjaman,
                locationUrl: url("/api/v1/peminjamans/{$peminjaman->id}"),
                message: "Peminjaman berhasil dicatat. Sisa stok buku: {$buku->fresh()->stok}."
            );
        });
    }

    /**
     * PATCH /api/v1/peminjamans/{id}/kembalikan
     * Mengembalikan buku dan memulihkan stok (+1) secara atomik
     */
    public function kembalikan(string $id): JsonResponse
    {
        return DB::transaction(function () use ($id) {
            $peminjaman = Peminjaman::find($id);

            if (!$peminjaman) {
                return $this->problemResponse(
                    title: 'Resource Not Found',
                    detail: 'Data transaksi peminjaman tidak ditemukan.',
                    status: 404,
                    errorSlug: 'peminjaman-not-found'
                );
            }

            if ($peminjaman->status === 'dikembalikan') {
                return $this->problemResponse(
                    title: 'Conflict Already Returned',
                    detail: 'Buku pada transaksi ini sudah pernah dikembalikan sebelumnya.',
                    status: 409,
                    errorSlug: 'sudah-dikembalikan'
                );
            }

            $buku = Buku::where('id', $peminjaman->buku_id)->lockForUpdate()->first();

            $peminjaman->update([
                'status'          => 'dikembalikan',
                'tanggal_kembali' => now()->toDateString(),
            ]);

            if ($buku) {
                $buku->increment('stok');
            }

            $peminjaman->load('buku');

            return $this->successResponse(
                data: $peminjaman,
                message: 'Buku berhasil dikembalikan dan stok perpustakaan telah diperbarui.'
            );
        });
    }
}