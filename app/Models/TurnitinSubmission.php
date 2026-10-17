<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TurnitinSubmission extends Model
{
    use HasFactory;

    protected $table = 'turnitin_submissions';

    protected $fillable = [
        'nama_mahasiswa',
        'nim',
        'email',
        'judul_dokumen',
        'jenis_dokumen',
        'file_path',
        'file_name',
        'catatan',
        'status',
    ];
}
