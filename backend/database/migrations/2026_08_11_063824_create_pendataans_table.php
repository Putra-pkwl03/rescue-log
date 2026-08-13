<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah nama tabel menjadi 'pendataans' (plural)
        Schema::create('pendataans', function (Blueprint $table) {
            $table->id();
            
            // Ganti user_id menjadi posko_id
            $table->foreignId('posko_id')->constrained('poskos')->onDelete('cascade');
            
            // Data Kategori Pengungsi (dibuat default 0 agar aman jika ada data kosong)
            $table->integer('total_pengungsi')->default(0);
            $table->integer('balita')->default(0);
            $table->integer('dewasa')->default(0);
            $table->integer('ibu_hamil')->default(0);
            $table->integer('lansia')->default(0);
            $table->integer('disabilitas')->default(0);

            // Condition & Facility (dibuat nullable agar form lebih fleksibel)
            $table->string('tipe_tempat')->nullable();
            $table->string('akses_air')->nullable();
            $table->string('akses_jalan')->nullable();
            $table->integer('lama_pengungsian')->nullable();

            // Parameter BMKG
            $table->float('suhu_celcius')->default(28.5);
            $table->string('cuaca')->default('Hujan Deras');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendataans');
    }
};