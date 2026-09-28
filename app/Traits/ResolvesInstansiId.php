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

    /**
     * Ambil id_instansi level 1 (induk tertinggi / Sekda) dari instansi
     * milik user yang login.
     *
     * - Kalau user login sebagai Instansi/Sekda (level 1, id_instansi_induk null),
     *   ini akan mengembalikan id miliknya sendiri.
     * - Kalau user login sebagai Unit Layanan (level 2, punya id_instansi_induk),
     *   ini akan naik satu tingkat ke induknya.
     *
     * Dipakai khusus untuk data yang DIKELOLA di level Sekda/Instansi tapi
     * DITAMPILKAN di level Unit Layanan, misalnya Maklumat.
     */
    protected function currentInduknyaInstansiId(): int
    {
        $id = $this->currentInstansiId();

        $instansi = Instansi::find($id);

        if ($instansi && $instansi->id_instansi_induk) {
            return $instansi->id_instansi_induk;
        }

        return $id;
    }
}