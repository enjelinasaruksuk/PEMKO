<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('instansi', function (Blueprint $table) {
            $table->id('id_instansi');
            $table->foreignId('id_instansi_induk')
                  ->nullable()
                  ->constrained('instansi', 'id_instansi')
                  ->nullOnDelete();
            $table->string('nama_instansi');
            $table->tinyInteger('level_instansi'); // 1 = Level 1, 2 = Level 2
            $table->string('email_instansi')->nullable();
            $table->enum('status', ['pending', 'aktif', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('instansi');
    }
};