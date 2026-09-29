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
    Schema::table('sk', function (Blueprint $table) {
        $table->string('ttd_nama')->nullable();
        $table->string('ttd_nip')->nullable();
        $table->string('ttd_pangkat')->nullable();
        $table->string('ttd_jabatan')->nullable();
    });
}
public function down(): void
{
    Schema::table('sk', fn (Blueprint $t) => $t->dropColumn(['ttd_nama','ttd_nip','ttd_pangkat','ttd_jabatan']));
}
};