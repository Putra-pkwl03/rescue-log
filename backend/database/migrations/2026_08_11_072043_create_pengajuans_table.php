<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Posko Kecil pengaju
            $table->string('kode_pengajuan')->unique(); // Contoh: REQ-20260811-001
            
            // Status Pengajuan (pending, approved, rejected, partial)
            $table->enum('status', ['pending', 'approved', 'rejected', 'partial'])->default('pending');
            $table->text('catatan_posko')->nullable();

            // Item Logistik Kebutuhan Utama
            $table->float('beras_kg')->default(0);
            $table->integer('makanan_kaleng_pack')->default(0);
            $table->integer('makanan_bayi_pack')->default(0);
            $table->float('minyak_goreng_liter')->default(0);
            $table->integer('air_minum_dus')->default(0);
            $table->integer('popok_bayi_pcs')->default(0);
            $table->integer('popok_dewasa_pcs')->default(0);
            $table->integer('pembalut_wanita_pack')->default(0);
            $table->integer('hygiene_kit_paket')->default(0);
            $table->integer('selimut_pcs')->default(0);
            $table->integer('matras_terpal_pcs')->default(0);
            $table->integer('obat_p3k_paket')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};