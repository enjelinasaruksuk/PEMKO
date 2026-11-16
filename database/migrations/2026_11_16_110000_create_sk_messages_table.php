<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sk_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sk_id')->constrained('sk')->cascadeOnDelete();
            $table->string('sender_role', 32);
            $table->string('sender_name');
            $table->text('message');
            $table->timestamps();

            $table->index(['sk_id', 'created_at']);
        });

        DB::table('sk')
            ->whereNotNull('catatan_konfirmasi')
            ->where('catatan_konfirmasi', '<>', '')
            ->orderBy('id')
            ->chunkById(100, function ($sks): void {
                foreach ($sks as $sk) {
                    $timestamp = $sk->updated_at ?? now();
                    DB::table('sk_messages')->insert([
                        'sk_id' => $sk->id,
                        'sender_role' => 'unit_layanan',
                        'sender_name' => 'Unit Pelayanan',
                        'message' => $sk->catatan_konfirmasi,
                        'created_at' => $timestamp,
                        'updated_at' => $timestamp,
                    ]);
                }
            });

        DB::table('sk')
            ->whereNotNull('review_comment')
            ->where('review_comment', '<>', '')
            ->orderBy('id')
            ->chunkById(100, function ($sks): void {
                foreach ($sks as $sk) {
                    $timestamp = $sk->admin_reviewed_at ?? $sk->updated_at ?? now();
                    DB::table('sk_messages')->insert([
                        'sk_id' => $sk->id,
                        'sender_role' => 'admin',
                        'sender_name' => 'Admin',
                        'message' => $sk->review_comment,
                        'created_at' => $timestamp,
                        'updated_at' => $timestamp,
                    ]);
                }
            });
    }

    public function down(): void
    {
        Schema::dropIfExists('sk_messages');
    }
};
