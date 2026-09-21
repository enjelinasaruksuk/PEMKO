<?php

namespace App\Traits;

use App\Models\Instansi;

trait ResolvesInstansiId
{
    /**
     * Ambil id_instansi milik user yang login.
     * SEMENTARA (selama auth belum aktif): ambil id_instansi pertama
     * yang benar-benar ada di tabel instansi, supaya tidak melanggar
     * foreign key constraint. Setelah auth aktif, baris fallback ini
     * bisa dihapus.
     */
    protected function currentInstansiId(): int
    {
        if (auth()->check() && auth()->user()->id_instansi) {
            return auth()->user()->id_instansi;
        }

        $fallbackId = Instansi::query()->value('id_instansi');

        if (! $fallbackId) {
            abort(500, 'Belum ada data instansi di database. Tambahkan minimal satu data instansi terlebih dahulu.');
        }

        return $fallbackId;
    }
}