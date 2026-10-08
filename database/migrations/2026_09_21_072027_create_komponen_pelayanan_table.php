<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('komponen_pelayanan', function (Blueprint $table) {
            $table->id('id_komponen');

            $table->string('nama_komponen');
            $table->string('kategori');

            $table->timestamps();

            $table->index('kategori');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('komponen_pelayanan');
    }
};