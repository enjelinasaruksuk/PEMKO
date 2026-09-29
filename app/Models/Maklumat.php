<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maklumat extends Model
{
    protected $table = 'maklumat';

    protected $fillable = [
        'id_instansi',
        'isi_maklumat',
        'nama_penjabat',
        'nip_penjabat',
        'tanggal_input',
        'status',
    ];

    protected $casts = [
        'tanggal_input' => 'date',
    ];

    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi', 'id_instansi');
    }
}
