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
    Schema::table('profil_unit_layanan', function (Blueprint $table) {
        $table->string('nama_jabatan')->nullable()->after('nama_kepala'); // mis. "Sekretaris Daerah"
    });
}
public function down(): void
{
    Schema::table('profil_unit_layanan', fn (Blueprint $t) => $t->dropColumn('nama_jabatan'));
}   
};