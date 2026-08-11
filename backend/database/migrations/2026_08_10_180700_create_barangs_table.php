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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->unique()->nullable();  // Contoh: BRG-001, LOG-102
            $table->string('nama_barang');                       // Contoh: Beras Premium, Mie Instan, Selimut
            $table->string('kategori')->nullable();              // Contoh: Makanan, Pakaian, Obat-obatan, Tenda
            $table->string('satuan_default', 50)->default('Pcs'); // Contoh: Dus, Kg, Pcs, Paket
            $table->text('deskripsi')->nullable();               // Keterangan atau spesifikasi barang
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};