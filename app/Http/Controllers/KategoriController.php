<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     * Menggunakan withCount untuk menghindari N+1 query saat menampilkan jumlah buku.
     */
    public function index()
    {
        $kategoris = Kategori::withCount('bukus')
            ->orderBy('nama_kategori')
            ->paginate(10);

        return view('kategori.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_kategori' => 'required|string|unique:kategoris,kode_kategori',
            'nama_kategori' => 'required|string|min:3',
        ], [
            'kode_kategori.required' => 'Kode kategori wajib diisi.',
            'kode_kategori.unique'   => 'Kode kategori sudah digunakan.',
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.min'      => 'Nama kategori minimal 3 karakter.',
        ]);

        Kategori::create($validated);

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        $kategori->load(['bukus' => function ($query) {
            $query->latest()->paginate(10);
        }]);

        $bukus = $kategori->bukus()->latest()->paginate(10);

        return view('kategori.show', compact('kategori', 'bukus'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'kode_kategori' => 'required|string|unique:kategoris,kode_kategori,' . $kategori->id,
            'nama_kategori' => 'required|string|min:3',
        ], [
            'kode_kategori.required' => 'Kode kategori wajib diisi.',
            'kode_kategori.unique'   => 'Kode kategori sudah digunakan oleh kategori lain.',
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.min'      => 'Nama kategori minimal 3 karakter.',
        ]);

        $kategori->update($validated);

        return redirect()->route('kategori.show', $kategori)
            ->with('success', 'Data kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        // Cek apakah masih ada buku dalam kategori ini
        if ($kategori->bukus()->count() > 0) {
            return redirect()->route('kategori.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki ' . $kategori->bukus()->count() . ' buku.');
        }

        $kategori->delete();

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
