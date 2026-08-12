<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan_kebutuhan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengajuan')->unique();
            $table->foreignId('posko_id')->nullable()->constrained('poskos')->nullOnDelete();
            $table->foreignId('bencana_id')->constrained('bencana')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->dateTime('tanggal_pengajuan');
            $table->enum('status', ['pending', 'disetujui', 'disetujui_sebagian', 'ditolak'])->default('pending');
            $table->text('catatan_komando')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan_kebutuhan');
    }
};