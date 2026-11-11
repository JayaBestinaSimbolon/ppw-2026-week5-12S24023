<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'Daftar koleksi buku perpustakaan berhasil diambil.', 'data' => Buku::paginate(10)], 200);
    }

    public function store(Request $request)
    {
        $buku = Buku::create($request->all());
        return response()->json(['message' => 'Buku berhasil ditambahkan', 'data' => $buku], 201);
    }

    public function show($id)
    {
        $buku = Buku::findOrFail($id);
        return response()->json(['data' => $buku], 200);
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);
        $buku->update($request->all());
        return response()->json(['message' => 'Buku berhasil diperbarui', 'data' => $buku], 200);
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();
        return response()->json(['message' => 'Buku berhasil dihapus'], 200);
    }
}