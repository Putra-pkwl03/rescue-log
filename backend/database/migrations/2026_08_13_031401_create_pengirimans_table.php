<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengirimans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengiriman')->unique(); // DIST-20260813-XXXX
            
            // Relasi ke Pengajuan Kebutuhan (Disesuaikan dari pengajuans -> pengajuan_kebutuhan)
            $table->foreignId('pengajuan_id')
                  ->constrained('pengajuan_kebutuhan')
                  ->onDelete('cascade');

            // Relasi ke Armada
            $table->foreignId('armada_id')
                  ->constrained('armadas')
                  ->onDelete('cascade');

            // Posko Asal & Tujuan
            $table->foreignId('posko_asal_id')
                  ->nullable()
                  ->constrained('poskos')
                  ->onDelete('set null');

            $table->foreignId('posko_tujuan_id')
                  ->nullable()
                  ->constrained('poskos')
                  ->onDelete('set null');

            $table->date('tanggal_kirim');
            
            $table->enum('status_pengiriman', [
                'dijadwalkan', 
                'dalam_perjalanan', 
                'terkirim', 
                'gagal'
            ])->default('dijadwalkan');

            $table->text('catatan_rute')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengirimans');
    }
};