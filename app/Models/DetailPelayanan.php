<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPelayanan extends Model
{
    protected $table = 'detail_pelayanan';
    protected $primaryKey = 'id_detail_pelayanan';
    protected $fillable = ['id_pelayanan', 'id_komponen', 'isi_komponen'];

    public function pelayanan()
    {
        return $this->belongsTo(Pelayanan::class, 'id_pelayanan');
    }

    public function komponen()
    {
        return $this->belongsTo(KomponenPelayanan::class, 'id_komponen', 'id_komponen');
    }
}