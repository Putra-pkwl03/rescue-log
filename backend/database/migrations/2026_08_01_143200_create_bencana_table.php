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
        Schema::create('bencana', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_bencana');
            $table->string('lokasi_bencana');
            $table->decimal('koordinat_operasional_lat', 10, 7)->nullable();
            $table->decimal('koordinat_operasional_lng', 10, 7)->nullable();
            $table->timestamp('tanggal_aktivasi');
            $table->timestamp('tanggal_selesai')->nullable();
            $table->enum('status', ['sedang_berjalan', 'selesai'])->default('sedang_berjalan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bencana');
    }
};