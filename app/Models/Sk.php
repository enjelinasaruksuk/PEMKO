<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Sk extends Model
{
    protected $table = 'sk';

    protected $fillable = [
        'id_instansi',
        'no_sk',
        'tanggal_sk',
        'jenis_sk',
        'no_sk_sebelumnya',
        'status',
        'pengesahan',
        'catatan_konfirmasi',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_sk' => 'date',
        ];
    }

    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi', 'id_instansi');
    }

    /**
     * Nama dinas ditampilkan berdasarkan instansi pemilik SK,
     * supaya view lama (yang mengakses $sk->nama_dinas) tetap jalan
     * tanpa perlu menyimpan nama dinas secara redundan.
     */
    public function getNamaDinasAttribute(): ?string
    {
        return $this->instansi?->nama_instansi;
    }

    public function scopeMilikInstansi(Builder $query, int $idInstansi): Builder
    {
        return $query->where('id_instansi', $idInstansi);
    }
}
