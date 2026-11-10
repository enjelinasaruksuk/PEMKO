<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tanda_tangan', function (Blueprint $table) {
            $table->longText('gambar')->nullable()->after('path'); // PNG dalam base64
            $table->string('path')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('tanda_tangan', function (Blueprint $table) {
            $table->dropColumn('gambar');
        });
    }
};