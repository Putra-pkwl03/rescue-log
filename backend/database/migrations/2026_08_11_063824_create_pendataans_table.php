<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendataan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Data Kategori Pengungsi
            $table->integer('total_pengungsi');
            $table->integer('balita');
            $table->integer('dewasa');
            $table->integer('ibu_hamil');
            $table->integer('lansia');
            $table->integer('disabilitas');

            // Condition & Facility
            $table->string('tipe_tempat');
            $table->string('akses_air');
            $table->string('akses_jalan');
            $table->integer('lama_pengungsian');

            // Parameter BMKG
            $table->float('suhu_celcius')->default(28.5);
            $table->string('cuaca')->default('Hujan Deras');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendataan');
    }
};