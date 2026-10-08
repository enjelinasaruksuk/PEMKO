<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_pelayanan', function (Blueprint $table) {
            $table->id('id_detail_pelayanan');

            $table->foreignId('id_pelayanan')
                ->constrained('pelayanan')
                ->cascadeOnDelete();

            $table->foreignId('id_komponen')
                ->constrained('komponen_pelayanan', 'id_komponen')
                ->cascadeOnDelete();

            $table->longText('isi_komponen')->nullable();

            $table->timestamps();

            $table->unique([
                'id_pelayanan',
                'id_komponen'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_pelayanan');
    }
};