<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stok_inventaris', function (Blueprint $table) {
            $table->foreignId('posko_id')->nullable()->after('id')->constrained('poskos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('stok_inventaris', function (Blueprint $table) {
            $table->dropForeign(['posko_id']);
            $table->dropColumn('posko_id');
        });
    }
};