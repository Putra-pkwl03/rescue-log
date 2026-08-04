<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('lapangan')->after('email');
            
            // Catat: Pastikan nama tabelnya 'bpbd' atau 'bpbds'
            $table->foreignId('bpbd_id')
                  ->nullable()
                  ->constrained('bpbd') 
                  ->onDelete('cascade');
            
            $table->foreignId('posko_id')
                  ->nullable()
                  ->after('role')
                  ->constrained('poskos')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus foreign key terlebih dahulu
            $table->dropForeign(['posko_id']);
            $table->dropForeign(['bpbd_id']);

            // Hapus semua kolom yang ditambahkan
            $table->dropColumn(['role', 'posko_id', 'bpbd_id']);
        });
    }
};