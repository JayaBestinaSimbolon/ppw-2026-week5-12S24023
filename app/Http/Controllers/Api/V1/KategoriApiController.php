<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class KategoriApiController extends Controller
{
    // Menggunakan cetakan respons JSON yang sudah Anda buat
    use ApiResponse;

    /**
     * Menampilkan daftar semua kategori
     */
    public function index()
    {
        $kategoris = Kategori::all();
        return $this->successResponse('Daftar kategori berhasil diambil.', $kategoris);
    }

    /**
     * Menyimpan data kategori baru
     */
    public function store(Request $request)
    {
        // Validasi input (sesuaikan 'nama_kategori' jika di database Anda bernama 'nama')
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255'
        ]);

        $kategori = Kategori::create($validated);
        
        return $this->createdResponse('Kategori berhasil ditambahkan.', $kategori);
    }

    /**
     * Menampilkan detail satu kategori berdasarkan ID
     */
    public function show(string $id)
    {
        $kategori = Kategori::find($id);
        
        if (!$kategori) {
            return $this->problemResponse('Kategori tidak ditemukan.', 404, 'Not Found');
        }

        return $this->successResponse('Detail kategori berhasil diambil.', $kategori);
    }

    /**
     * Mengubah data kategori
     */
    public function update(Request $request, string $id)
    {
        $kategori = Kategori::find($id);
        
        if (!$kategori) {
            return $this->problemResponse('Kategori tidak ditemukan.', 404, 'Not Found');
        }

        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255'
        ]);

        $kategori->update($validated);
        
        return $this->successResponse('Kategori berhasil diperbarui.', $kategori);
    }

    /**
     * Menghapus data kategori
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::find($id);
        
        if (!$kategori) {
            return $this->problemResponse('Kategori tidak ditemukan.', 404, 'Not Found');
        }

        $kategori->delete();
        
        // Mengembalikan status 204 No Content untuk penghapusan yang sukses
        return $this->noContentResponse();
    }
}