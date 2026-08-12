<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('armadas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_armada'); // Cth: Truk TNI AD 01
            $table->string('plat_nomor')->unique();
            $table->string('nama_driver');
            $table->string('no_hp')->nullable();
            $table->enum('status', ['tersedia', 'dalam_tugas', 'maintenance'])->default('tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('armadas');
    }
};
