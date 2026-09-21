<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('perda', function (Blueprint $table) {
            $table->dropColumn('nomor');
        });

        Schema::table('perwali', function (Blueprint $table) {
            $table->dropColumn('nomor');
        });
    }

    public function down(): void
    {
        Schema::table('perda', function (Blueprint $table) {
            $table->string('nomor')->nullable();
        });

        Schema::table('perwali', function (Blueprint $table) {
            $table->string('nomor')->nullable();
        });
    }
};