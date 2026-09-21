<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perwali extends Model
{
    protected $table = 'perwali';

    protected $fillable = [
        'id_instansi',
        'tentang',
    ];

    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi', 'id_instansi');
    }
}