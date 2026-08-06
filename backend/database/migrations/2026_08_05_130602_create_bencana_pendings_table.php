<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bencana_pendings', function (Blueprint $table) {
            $table->id();
            $table->string('external_id')->unique(); // Mencegah duplikasi data (Hash Tanggal+Jam BMKG)
            $table->string('sumber_api')->default('BMKG TEWS');
            $table->string('jenis_bencana')->default('Gempabumi');
            $table->text('wilayah');
            $table->string('magnitude')->nullable();
            $table->string('kedalaman')->nullable();
            $table->string('potensi')->nullable(); // Misal: Tidak berpotensi Tsunami
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->timestamp('waktu_kejadian');
            $table->json('raw_payload')->nullable(); // Menyimpan response mentah JSON BMKG
            $table->enum('status', ['pending', 'validated', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bencana_pendings');
    }
};