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
        Schema::create('poskos', function (Blueprint $table) {
            $table->id();
            $table->string('nama_posko');
            
            // Hierarki: Komando (Utama) vs Lapangan Kecil
            $table->enum('tipe_posko', ['komando', 'lapangan_kecil'])->default('lapangan_kecil');
            
            // Foreign Key ke Posko Induk (Self-Referencing untuk Posko Kecil)
            $table->foreignId('parent_id')
                  ->nullable()
                  ->constrained('poskos')
                  ->onDelete('cascade');
            
            $table->text('lokasi');
            $table->integer('kapasitas_maksimal');
            $table->string('penanggung_jawab');
            $table->string('kontak_hp');
            $table->enum('status', ['aktif', 'penuh', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poskos');
    }
};