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

            // Relasi ke barang stok gudang
            $table->foreignId('stok_inventaris_id')
                  ->constrained('stok_inventaris')
                  ->onDelete('cascade');

            // Relasi ke posko komando tujuan (tabel poskos)
            $table->foreignId('posko_id')
                  ->constrained('poskos')
                  ->onDelete('cascade');

            // Relasi ke user / petugas yang mencatat pengiriman
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null');

            // Detail pengiriman
            $table->integer('jumlah_dikirim');
            $table->text('keterangan')->nullable();

            // Timestamps (created_at menjadi acuan batas 20 menit)
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