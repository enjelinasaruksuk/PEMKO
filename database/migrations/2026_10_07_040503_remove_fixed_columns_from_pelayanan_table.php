<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pelayanan', function (Blueprint $table) {
            $table->dropColumn([
                'persyaratan',
                'sistem_mekanisme_prosedur',
                'jangka_waktu',
                'biaya',
                'produk_pelayanan',
                'penanganan_pengaduan',
                'dasar_hukum',
                'sarana_prasarana',
                'kompetensi_pelaksana',
                'pengawasan_internal',
                'jumlah_pelaksana',
                'jaminan_pelayanan',
                'jaminan_keamanan',
                'evaluasi_kinerja',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('pelayanan', function (Blueprint $table) {
            $table->longText('persyaratan')->nullable();
            $table->longText('sistem_mekanisme_prosedur')->nullable();
            $table->longText('jangka_waktu')->nullable();
            $table->longText('biaya')->nullable();
            $table->longText('produk_pelayanan')->nullable();
            $table->longText('penanganan_pengaduan')->nullable();
            $table->longText('dasar_hukum')->nullable();
            $table->longText('sarana_prasarana')->nullable();
            $table->longText('kompetensi_pelaksana')->nullable();
            $table->longText('pengawasan_internal')->nullable();
            $table->longText('jumlah_pelaksana')->nullable();
            $table->longText('jaminan_pelayanan')->nullable();
            $table->longText('jaminan_keamanan')->nullable();
            $table->longText('evaluasi_kinerja')->nullable();
        });
    }
};