<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengiriman_inventaris', function (Blueprint $table) {
            $table->foreignId('pengajuan_id')->nullable()->after('id')->constrained('pengajuans')->onDelete('cascade');
            $table->foreignId('stok_inventaris_id')->nullable()->change();
            $table->string('status_distribusi')->default('Dalam Pengiriman')->after('jumlah_dikirim');
            $table->string('estimasi_waktu')->nullable()->after('status_distribusi');
            $table->timestamp('waktu_diterima')->nullable()->after('estimasi_waktu');
        });
    }

    public function down(): void
    {
        Schema::table('pengiriman_inventaris', function (Blueprint $table) {
            $table->dropForeign(['pengajuan_id']);
            $table->dropColumn(['pengajuan_id', 'status_distribusi', 'estimasi_waktu', 'waktu_diterima']);
        });
    }
};