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

    public function details()
    {
        return $this->hasMany(DetailPelayanan::class, 'id_pelayanan');
    }

    /**
     * Ambil isi komponen sebagai array [id_komponen => isi_komponen],
     * memudahkan pre-fill form edit.
     */
    public function komponenMap(): array
    {
        return $this->details->pluck('isi_komponen', 'id_komponen')->toArray();
    }

    public function scopeMilikInstansi(Builder $query, int $idInstansi): Builder
    {
        return $query->where('id_instansi', $idInstansi);
    }
}