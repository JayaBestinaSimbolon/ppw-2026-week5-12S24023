<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\BukuResource;
use App\Models\Buku;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BukuApiController extends Controller
{
    use ApiResponse;

    /**
     * GET /api/v1/bukus
     * Menampilkan daftar koleksi buku dengan Filter, Search, Sorting, & Paginasi
     */
    public function index(Request $request): JsonResponse
    {
        $allowedSorts = ['judul', 'penulis', 'tahun_terbit', 'stok', 'created_at'];
        $sortBy = in_array($request->query('sort'), $allowedSorts) ? $request->query('sort') : 'judul';
        $sortDir = strtolower($request->query('dir', 'asc')) === 'desc' ? 'desc' : 'asc';
        $perPage = min(max((int) $request->query('per_page', 5), 1), 50);

        $paginator = Buku::query()
            ->with('kategori')
            ->when($request->query('search'), function ($q, $search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('judul', 'like', "%{$search}%")
                        ->orWhere('penulis', 'like', "%{$search}%")
                        ->orWhere('isbn', 'like', "%{$search}%");
                });
            })
            ->when($request->query('kategori_id'), fn ($q, $katId) => $q->where('kategori_id', $katId))
            ->when($request->boolean('tersedia'), fn ($q) => $q->where('stok', '>', 0))
            ->orderBy($sortBy, $sortDir)
            ->paginate($perPage)
            ->withQueryString();

        return $this->successResponse(
            data: BukuResource::collection($paginator->items()),
            message: 'Daftar koleksi buku perpustakaan berhasil diambil.',
            meta: [
                'current_page' => $paginator->currentPage(),
                'per_page'     => $paginator->perPage(),
                'total_items'  => $paginator->total(),
                'total_pages'  => $paginator->lastPage(),
                'links'        => [
                    'first' => $paginator->url(1),
                    'prev'  => $paginator->previousPageUrl(),
                    'next'  => $paginator->nextPageUrl(),
                    'last'  => $paginator->url($paginator->lastPage()),
                ]
            ]
        );
    }

    /**
     * GET /api/v1/bukus/{id}
     * Menampilkan detail satu buku berdasarkan ID atau ISBN
     */
    public function show(string $identifier): JsonResponse
    {
        $buku = Buku::with('kategori')
            ->where('id', $identifier)
            ->orWhere('isbn', $identifier)
            ->first();

        if (!$buku) {
            return $this->problemResponse(
                title: 'Resource Not Found',
                detail: "Buku dengan pengenal '{$identifier}' tidak ditemukan di basis data.",
                status: 404,
                errorSlug: 'buku-not-found'
            );
        }

        return $this->successResponse(
            data: new BukuResource($buku),
            message: 'Detail buku berhasil ditemukan.'
        );
    }

    /**
     * POST /api/v1/bukus
     * Menambah buku baru (Membutuhkan Bearer Token)
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'isbn'          => 'required|string|max:50|unique:bukus,isbn',
            'judul'         => 'required|string|max:255',
            'penulis'       => 'required|string|max:255',
            'penerbit'      => 'required|string|max:255',
            'tahun_terbit'  => 'required|integer|min:1900|max:2100',
            'kategori_id'   => 'required|exists:kategoris,id',
            'jenis_koleksi' => 'required|string|in:Buku Pelajaran,Skripsi',
            'lantai'        => 'required|integer|in:1,2',
            'kode_rak'      => 'nullable|string|max:50',
            'stok'          => 'required|integer|min:0|max:500',
            'sinopsis'      => 'nullable|string|max:2000',
        ]);

        $buku = Buku::create($validated);
        $buku->load('kategori');

        return $this->createdResponse(
            data: new BukuResource($buku),
            locationUrl: url("/api/v1/bukus/{$buku->id}"),
            message: 'Buku baru berhasil ditambahkan ke katalog.'
        );
    }

    /**
     * PUT / PATCH /api/v1/bukus/{id}
     * Memperbarui data buku
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $buku = Buku::find($id);
        if (!$buku) {
            return $this->problemResponse(
                title: 'Resource Not Found',
                detail: "Buku dengan ID '{$id}' tidak ditemukan.",
                status: 404,
                errorSlug: 'buku-not-found'
            );
        }

        $isPut = $request->isMethod('put');

        if ($isPut) {
            $validated = $request->validate([
                'isbn'          => "required|string|max:50|unique:bukus,isbn,{$buku->id}",
                'judul'         => 'required|string|max:255',
                'penulis'       => 'required|string|max:255',
                'penerbit'      => 'required|string|max:255',
                'tahun_terbit'  => 'required|integer|min:1900|max:2100',
                'kategori_id'   => 'required|exists:kategoris,id',
                'jenis_koleksi' => 'required|string|in:Buku Pelajaran,Skripsi',
                'lantai'        => 'required|integer|in:1,2',
                'kode_rak'      => 'nullable|string|max:50',
                'stok'          => 'required|integer|min:0|max:500',
                'sinopsis'      => 'nullable|string|max:2000',
            ]);
        } else {
            $validated = $request->validate([
                'isbn'          => "sometimes|required|string|max:50|unique:bukus,isbn,{$buku->id}",
                'judul'         => 'sometimes|required|string|max:255',
                'penulis'       => 'sometimes|required|string|max:255',
                'penerbit'      => 'sometimes|required|string|max:255',
                'tahun_terbit'  => 'sometimes|required|integer|min:1900|max:2100',
                'kategori_id'   => 'sometimes|required|exists:kategoris,id',
                'jenis_koleksi' => 'sometimes|required|string|in:Buku Pelajaran,Skripsi',
                'lantai'        => 'sometimes|required|integer|in:1,2',
                'kode_rak'      => 'sometimes|nullable|string|max:50',
                'stok'          => 'sometimes|required|integer|min:0|max:500',
                'sinopsis'      => 'sometimes|nullable|string|max:2000',
            ]);

            if (empty($validated)) {
                return $this->problemResponse(
                    title: 'Bad Request',
                    detail: 'Permintaan PATCH wajib menyertakan minimal satu atribut yang ingin diperbarui.',
                    status: 400,
                    errorSlug: 'empty-patch-payload'
                );
            }
        }

        $buku->update($validated);
        $buku->load('kategori');

        return $this->successResponse(
            data: new BukuResource($buku),
            message: $isPut 
                ? 'Seluruh data buku berhasil diganti (PUT).' 
                : 'Atribut buku berhasil diperbarui sebagian (PATCH).'
        );
    }

    /**
     * DELETE /api/v1/bukus/{id}
     * Menghapus buku (Ditolak 409 jika sedang dipinjam)
     */
    public function destroy(string $id): JsonResponse
    {
        $buku = Buku::withCount(['peminjamans' => fn ($q) => $q->where('status', 'dipinjam')])->find($id);

        if (!$buku) {
            return $this->problemResponse(
                title: 'Resource Not Found',
                detail: "Buku dengan ID '{$id}' tidak ditemukan.",
                status: 404,
                errorSlug: 'buku-not-found'
            );
        }

        if ($buku->peminjamans_count > 0) {
            return $this->problemResponse(
                title: 'Conflict Active Loans Exist',
                detail: "Buku '{$buku->judul}' tidak dapat dihapus karena sedang dalam status dipinjam oleh mahasiswa.",
                status: 409,
                errorSlug: 'buku-has-active-loans'
            );
        }

        $buku->delete();

        return $this->noContentResponse();
    }
}