<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profil_unit_layanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_instansi')->constrained('instansi', 'id_instansi')->cascadeOnDelete();
            $table->string('nama_unit')->nullable();
            $table->string('nama_kepala')->nullable();
            $table->string('jabatan')->nullable(); // Non PLT / PLT
            $table->string('website')->nullable();
            $table->text('alamat')->nullable();
            $table->string('nip')->nullable();
            $table->string('pangkat')->nullable();
            $table->string('email')->nullable();
            $table->text('misi')->nullable();
            $table->string('telepon')->nullable();
            $table->string('faksimile')->nullable();
            $table->text('motto')->nullable();
            $table->text('visi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil_unit_layanan');
    }
};