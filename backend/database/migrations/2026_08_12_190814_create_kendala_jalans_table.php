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
        Schema::create('kendala_jalans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lokasi'); 
            $table->enum('jenis_kendala', [
                'longsor', 
                'jembatan_putus', 
                'banjir', 
                'pohon_tumbang', 
                'jalan_rusak'
            ]);
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->text('deskripsi')->nullable();
            $table->boolean('is_active')->default(true); 
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendala_jalans');
    }
};