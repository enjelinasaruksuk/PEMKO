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
        Schema::create('pelayanan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_instansi')
                ->constrained('instansi', 'id_instansi')
                ->cascadeOnDelete();

            $table->string('nama_layanan');

            // Penyampaian Layanan
            $table->longText('persyaratan')->nullable();
            $table->longText('sistem_mekanisme_prosedur')->nullable();
            $table->longText('jangka_waktu')->nullable();
            $table->longText('biaya')->nullable();
            $table->longText('produk_pelayanan')->nullable();
            $table->longText('penanganan_pengaduan')->nullable();

            // Pengelolaan Pelayanan
            $table->longText('dasar_hukum')->nullable();
            $table->longText('sarana_prasarana')->nullable();
            $table->longText('kompetensi_pelaksana')->nullable();
            $table->longText('pengawasan_internal')->nullable();
            $table->longText('jumlah_pelaksana')->nullable();
            $table->longText('jaminan_pelayanan')->nullable();
            $table->longText('jaminan_keamanan')->nullable();
            $table->longText('evaluasi_kinerja')->nullable();

            $table->timestamps();

            $table->index(['id_instansi', 'nama_layanan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelayanan');
    }
};
