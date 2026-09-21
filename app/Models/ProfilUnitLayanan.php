<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilUnitLayanan extends Model
{
    protected $table = 'profil_unit_layanan';

    protected $fillable = [
        'id_instansi',
        'nama_unit',
        'nama_kepala',
        'jabatan',
        'website',
        'alamat',
        'nip',
        'pangkat',
        'email',
        'misi',
        'telepon',
        'faksimile',
        'motto',
        'visi',
    ];

    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi', 'id_instansi');
    }
}