<?php

namespace App\Http\Controllers;

use App\Models\TurnitinSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TurnitinController extends Controller
{
    /**
     * Tampilkan formulir dan informasi pengajuan cek Turnitin.
     */
    public function index()
    {
        // Ambil riwayat pengajuan terkini (maksimal 10)
        $submissions = TurnitinSubmission::latest()->take(10)->get();

        return view('turnitin.index', compact('submissions'));
    }

    /**
     * Simpan pengajuan dokumen Turnitin baru ke MySQL.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_mahasiswa' => 'required|string|max:100',
            'nim'            => 'required|string|max:30',
            'email'          => 'required|email|max:100',
            'judul_dokumen'  => 'required|string|min:5|max:255',
            'jenis_dokumen'  => 'required|in:Laporan,Makalah,Proposal,Tugas Akhir / Skripsi',
            'dokumen'        => 'required|file|mimes:pdf,doc,docx|max:15360', // Max 15MB
            'catatan'        => 'nullable|string|max:500',
        ], [
            'nama_mahasiswa.required' => 'Nama mahasiswa wajib diisi.',
            'nim.required'            => 'NIM mahasiswa wajib diisi.',
            'email.required'          => 'Alamat email aktif wajib diisi.',
            'email.email'             => 'Format alamat email tidak valid.',
            'judul_dokumen.required'  => 'Judul dokumen wajib diisi.',
            'judul_dokumen.min'       => 'Judul dokumen minimal 5 karakter.',
            'jenis_dokumen.required'  => 'Pilih jenis dokumen yang diajukan.',
            'dokumen.required'        => 'Berkas dokumen wajib diunggah.',
            'dokumen.mimes'           => 'Format berkas hanya diperbolehkan PDF, DOC, atau DOCX.',
            'dokumen.max'             => 'Ukuran berkas maksimal 15 MB.',
        ]);

        // Simpan file ke storage privat (non-public untuk privasi karya akademik)
        $file = $request->file('dokumen');
        $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
        $filePath = $file->storeAs('turnitin_documents', $fileName, 'local');

        TurnitinSubmission::create([
            'nama_mahasiswa' => $validated['nama_mahasiswa'],
            'nim'            => $validated['nim'],
            'email'          => $validated['email'],
            'judul_dokumen'  => $validated['judul_dokumen'],
            'jenis_dokumen'  => $validated['jenis_dokumen'],
            'file_path'      => $filePath,
            'file_name'      => $file->getClientOriginalName(),
            'catatan'        => $validated['catatan'] ?? null,
            'status'         => 'Menunggu',
        ]);

        return redirect()->route('turnitin.index')
            ->with('success', 'Pengajuan pemeriksaan Turnitin untuk dokumen "' . $validated['judul_dokumen'] . '" berhasil dikirim! Dokumen akan diproses oleh staf perpustakaan Del.');
    }
}
