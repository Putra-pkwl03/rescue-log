<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat_stok', function (Blueprint $table) {
            $table->id();
            $table->foreignId('posko_id')->constrained('poskos')->cascadeOnDelete(); 
            $table->foreignId('barang_id')->constrained('barangs')->cascadeOnDelete(); 
            $table->enum('jenis', ['masuk', 'keluar']);
            $table->integer('jumlah');
            $table->string('referensi')->comment('Contoh: pengajuan_bpbd, distribusi_lapangan');
            $table->unsignedBigInteger('referensi_id')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_stok');
    }
};