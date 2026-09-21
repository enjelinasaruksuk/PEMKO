<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perwali', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_instansi')->constrained('instansi', 'id_instansi')->cascadeOnDelete();
            $table->string('nomor')->nullable();
            $table->text('tentang');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perwali');
    }
};