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
        Schema::create('pengiriman_inventaris', function (Blueprint $table) {
            $table->id();

            // Relasi ke pengajuan kebutuhan
            $table->foreignId('pengajuan_id')
                  ->nullable()
                  ->constrained('pengajuan_kebutuhan')
                  ->onDelete('cascade');

            // Relasi ke barang stok gudang
            $table->foreignId('stok_inventaris_id')
                  ->nullable()
                  ->constrained('stok_inventaris')
                  ->onDelete('cascade');

            // Relasi ke posko tujuan
            $table->foreignId('posko_id')
                  ->constrained('poskos')
                  ->onDelete('cascade');

            // Detail pengiriman (Menggunakan float untuk pecahan)
            $table->float('jumlah_dikirim')->default(0);
            
            $table->string('status_distribusi')->default('Dalam Pengiriman');
            $table->string('estimasi_waktu')->nullable();
            $table->timestamp('waktu_diterima')->nullable();
            $table->text('keterangan')->nullable();

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengiriman_inventaris');
    }
};