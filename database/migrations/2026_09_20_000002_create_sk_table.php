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
        Schema::create('sk', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_instansi')
                ->constrained('instansi', 'id_instansi')
                ->cascadeOnDelete();

            $table->string('no_sk');
            $table->date('tanggal_sk');

            $table->enum('jenis_sk', ['SK Baru', 'Menggantikan SK Sebelumnya'])
                ->default('SK Baru');

            $table->string('no_sk_sebelumnya')->nullable();

            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif');

            $table->enum('pengesahan', ['Belum disetujui', 'Sudah disetujui'])
                ->default('Belum disetujui');

            $table->text('catatan_konfirmasi')->nullable();

            $table->timestamps();

            $table->index(['id_instansi', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sk');
    }
};
