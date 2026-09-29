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
            $table->string('review_status', 32)->default('draft')->after('konfirmasi');
            $table->text('review_comment')->nullable()->after('review_status');
            $table->timestamp('submitted_at')->nullable()->after('review_comment');
            $table->timestamp('admin_reviewed_at')->nullable()->after('submitted_at');
        });

        DB::table('sk')
            ->where('pengesahan', 'Sudah disetujui')
            ->update(['review_status' => 'disetujui']);
    }

    public function down(): void
    {
        Schema::table('sk', function (Blueprint $table) {
            $table->dropColumn([
                'review_status',
                'review_comment',
                'submitted_at',
                'admin_reviewed_at',
            ]);
        });
    }
};
