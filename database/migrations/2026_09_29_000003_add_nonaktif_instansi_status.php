<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('instansi', function (Blueprint $table) {
            $table->enum('status', ['pending', 'aktif', 'nonaktif', 'ditolak'])
                ->default('pending')
                ->change();
        });
    }

    public function down(): void
    {
        DB::table('instansi')
            ->where('status', 'nonaktif')
            ->update(['status' => 'pending']);

        Schema::table('instansi', function (Blueprint $table) {
            $table->enum('status', ['pending', 'aktif', 'ditolak'])
                ->default('pending')
                ->change();
        });
    }
};
