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
    Schema::create('tanda_tangan', function (Blueprint $table) {
        $table->string('nip', 30)->primary(); // hanya angka
        $table->string('path');               // mis. ttd/197103301998031005.png
        $table->timestamps();
    });
}
public function down(): void { Schema::dropIfExists('tanda_tangan'); }
};