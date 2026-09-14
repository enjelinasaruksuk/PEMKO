<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id('id_pengguna');
            $table->foreignId('id_role')->constrained('roles', 'id_role');
            $table->foreignId('id_instansi')->nullable()->constrained('instansi', 'id_instansi');
            $table->string('nama_pengguna');
            $table->string('username')->nullable()->unique();
            $table->string('password')->nullable();
            $table->enum('status', ['pending', 'aktif', 'nonaktif', 'ditolak'])->default('pending');
            $table->timestamp('masuk_terakhir')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};