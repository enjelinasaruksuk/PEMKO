<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    protected $table = 'instansi';
    protected $primaryKey = 'id_instansi';
    protected $fillable = ['id_instansi_induk', 'nama_instansi', 'level_instansi', 'email_instansi', 'status'];

    public function induk()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi_induk', 'id_instansi');
    }

    public function anak()
    {
        return $this->hasMany(Instansi::class, 'id_instansi_induk', 'id_instansi');
    }

    public function pengguna()
    {
        return $this->hasMany(Pengguna::class, 'id_instansi', 'id_instansi');
    }

    public function sk()
    {
        return $this->hasMany(Sk::class, 'id_instansi', 'id_instansi');
    }

    public function pelayanan()
    {
        return $this->hasMany(Pelayanan::class, 'id_instansi', 'id_instansi');
    }

    public function maklumat()
    {
        return $this->hasMany(Maklumat::class, 'id_instansi', 'id_instansi');
    }
}