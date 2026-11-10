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
    public const ISI_STANDAR = 'Kami siap memberikan pelayanan sesuai dengan standar pelayanan, melakukan perbaikan secara terus menerus, dan apabila kami tidak memberikan pelayanan sesuai dengan standar pelayanan yang telah ditetapkan, kami siap menerima sanksi dan/atau memberikan kompensasi sesuai dengan peraturan perundang-undangan yang berlaku.';
}
