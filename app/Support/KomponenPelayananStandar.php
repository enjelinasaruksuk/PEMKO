<?php

namespace App\Support;

/**
 * Sementara berupa data statis untuk kebutuhan tampilan/prototipe.
 * Setelah tabel `komponen_pelayanan` (dikelola Admin di menu
 * "Komponen Pelayanan") tersedia, ganti isi method grouped() dengan:
 *
 *   \App\Models\KomponenPelayanan::orderBy('urutan')->get()->groupBy('kategori');
 *
 * sehingga field pada form Nama Pelayanan (Unit Layanan) selalu
 * mengikuti master komponen yang didefinisikan Admin.
 */
class KomponenPelayananStandar
{
    /**
     * @return array{0: \Illuminate\Support\Collection, 1: \Illuminate\Support\Collection}
     */
    public static function grouped(): array
    {
        $penyampaian = collect([
            (object)['id' => 1, 'nama_komponen' => 'Persyaratan'],
            (object)['id' => 2, 'nama_komponen' => 'Sistem, Mekanisme dan Prosedur'],
            (object)['id' => 3, 'nama_komponen' => 'Jangka Waktu Pelayanan'],
            (object)['id' => 4, 'nama_komponen' => 'Biaya'],
            (object)['id' => 5, 'nama_komponen' => 'Produk Pelayanan'],
            (object)['id' => 6, 'nama_komponen' => 'Penanganan, Pengaduan, Saran dan Masukkan'],
        ]);

        $pengelolaan = collect([
            (object)['id' => 7,  'nama_komponen' => 'Dasar Hukum'],
            (object)['id' => 8,  'nama_komponen' => 'Sarana dan Prasarana, dan/atau Fasilitas'],
            (object)['id' => 9,  'nama_komponen' => 'Kompetensi Pelaksana'],
            (object)['id' => 10, 'nama_komponen' => 'Pengawasan Internal'],
            (object)['id' => 11, 'nama_komponen' => 'Jumlah Pelaksana'],
            (object)['id' => 12, 'nama_komponen' => 'Jaminan Pelayanan'],
            (object)['id' => 13, 'nama_komponen' => 'Jaminan Keamanan dan Keselamatan Pelayanan'],
            (object)['id' => 14, 'nama_komponen' => 'Evaluasi Kinerja Pelaksana'],
        ]);

        return [$penyampaian, $pengelolaan];
    }
}
