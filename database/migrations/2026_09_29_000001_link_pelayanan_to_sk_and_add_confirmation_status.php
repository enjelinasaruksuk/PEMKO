<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sk', function (Blueprint $table) {
            $table->enum('konfirmasi', ['Menunggu', 'Sudah disetujui'])
                ->default('Menunggu')
                ->after('pengesahan');
        });

        DB::table('sk')
            ->where('pengesahan', 'Sudah disetujui')
            ->update(['konfirmasi' => 'Sudah disetujui']);

        Schema::create('pelayanan_sk', function (Blueprint $table) {
            $table->foreignId('sk_id')->constrained('sk')->cascadeOnDelete();
            $table->foreignId('pelayanan_id')->constrained('pelayanan')->cascadeOnDelete();
            $table->timestamps();
            $table->primary(['sk_id', 'pelayanan_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelayanan_sk');

        Schema::table('sk', function (Blueprint $table) {
            $table->dropColumn('konfirmasi');
        });
    }
};
