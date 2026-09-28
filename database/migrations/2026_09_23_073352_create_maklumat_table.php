<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maklumat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_instansi')->constrained('instansi', 'id_instansi')->cascadeOnDelete();
            $table->text('isi_maklumat');
            $table->string('nama_penjabat')->nullable();
            $table->date('tanggal_input')->nullable();
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maklumat');
    }
};