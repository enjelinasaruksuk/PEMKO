<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Pelayanan extends Model
{
    protected $table = 'pelayanan';

    protected $fillable = [
        'id_instansi',
        'nama_layanan',
        // Penyampaian Layanan
        'persyaratan',
        'sistem_mekanisme_prosedur',
        'jangka_waktu',
        'biaya',
        'produk_pelayanan',
        'penanganan_pengaduan',
        // Pengelolaan Pelayanan
        'dasar_hukum',
        'sarana_prasarana',
        'kompetensi_pelaksana',
        'pengawasan_internal',
        'jumlah_pelaksana',
        'jaminan_pelayanan',
        'jaminan_keamanan',
        'evaluasi_kinerja',
    ];

    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi', 'id_instansi');
    }

    public function sks()
    {
        return $this->belongsToMany(Sk::class, 'pelayanan_sk', 'pelayanan_id', 'sk_id')
            ->withTimestamps();
    }

    /**
     * Scope a query to only the given instansi.
     */
    public function scopeMilikInstansi(Builder $query, int $idInstansi): Builder
    {
        return $query->where('id_instansi', $idInstansi);
    }
}
