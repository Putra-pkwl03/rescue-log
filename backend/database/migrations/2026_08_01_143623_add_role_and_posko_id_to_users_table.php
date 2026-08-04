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
        Schema::table('users', function (Blueprint $table) {
            // Peran akun
            $table->enum('role', ['admin', 'komando', 'lapangan'])
                  ->default('lapangan')
                  ->after('email');
            $table->foreignId('bpbd_id')->nullable()->constrained('bpbd')->onDelete('cascade');
            
            // Relasi ke Posko tempat petugas bertugas
            $table->foreignId('posko_id')
                  ->nullable()
                  ->after('role')
                  ->constrained('poskos')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['posko_id']);
            $table->dropColumn(['role', 'posko_id']);
            $table->dropForeign(['bpbd_id']);
            $table->dropColumn('bpbd_id');
        });
    }
};