<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan_kebutuhan_detail', function (Blueprint $table) {
            $table->id();

            // Relasi ke header pengajuan_kebutuhan
            $table->foreignId('pengajuan_kebutuhan_id')
                  ->constrained('pengajuan_kebutuhan')
                  ->cascadeOnDelete();

            // DIPERBAIKI: Mengarah ke tabel stok_inventaris
            $table->foreignId('barang_id')
                  ->constrained('stok_inventaris')
                  ->cascadeOnDelete();

            $table->integer('jumlah_diminta');
            $table->integer('jumlah_disetujui')->default(0);
            $table->string('satuan', 50);
            $table->string('keterangan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan_kebutuhan_detail');
    }
};