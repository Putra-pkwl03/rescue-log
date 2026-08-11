<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posko_fotos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('posko_id')->constrained('poskos')->onDelete('cascade');
            $table->string('path_file');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posko_fotos');
    }
};