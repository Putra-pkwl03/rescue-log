<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pengirimans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengiriman')->unique(); // Cth: DIST-2026-001
            
            // Relasi ke pengajuan yang sudah disetujui (Menu 2)
            $table->foreignId('pengajuan_kebutuhan_id')->constrained('pengajuan_kebutuhan')->onDelete('cascade');
            
            // Relasi ke Armada yang bertugas
            $table->foreignId('armada_id')->constrained('armadas')->onDelete('restrict');
            
            // Posko Asal & Posko Tujuan
            $table->foreignId('posko_asal_id')->constrained('poskos')->onDelete('cascade');
            $table->foreignId('posko_tujuan_id')->constrained('poskos')->onDelete('cascade');
            
            // Koordinat Peta untuk Maps Rute
            $table->string('lat_asal')->nullable();
            $table->string('long_asal')->nullable();
            $table->string('lat_tujuan')->nullable();
            $table->string('long_tujuan')->nullable();

            $table->dateTime('tanggal_kirim');
            $table->dateTime('estimasi_tiba')->nullable();
            
            // Status yang langsung tercermin di Posko Kecil (Menu 4)
            $table->enum('status_pengiriman', ['dijadwalkan', 'dalam_perjalanan', 'terkirim', 'batal'])
                  ->default('dijadwalkan');
                  
            $table->text('catatan_rute')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengirimans');
    }
};
