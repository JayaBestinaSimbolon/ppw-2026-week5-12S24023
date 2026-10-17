<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bukus', function (Blueprint $table) {
            $table->string('jenis_koleksi')->default('Buku Pelajaran')->after('kategori_id'); // 'Buku Pelajaran' atau 'Skripsi'
            $table->tinyInteger('lantai')->nullable()->after('jenis_koleksi'); // 1 atau 2
            $table->string('kode_rak', 50)->nullable()->after('lantai'); // misal 'A-01', 'B-02'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bukus', function (Blueprint $table) {
            $table->dropColumn(['jenis_koleksi', 'lantai', 'kode_rak']);
        });
    }
};
