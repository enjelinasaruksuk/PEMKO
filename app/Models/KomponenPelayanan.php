<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KomponenPelayanan extends Model
{
    protected $table = 'komponen_pelayanan';
    protected $primaryKey = 'id_komponen';
    protected $fillable = ['nama_komponen', 'kategori'];
}