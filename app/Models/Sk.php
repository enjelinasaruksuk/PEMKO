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
        'konfirmasi',
        'catatan_konfirmasi',
        'review_status',
        'review_comment',
        'submitted_at',
        'admin_reviewed_at',
        'ttd_nama',
        'ttd_nip',
        'ttd_pangkat',
        'ttd_jabatan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_sk' => 'date',
            'submitted_at' => 'datetime',
            'admin_reviewed_at' => 'datetime',
        ];
    }

    public const REVIEW_DRAFT = 'draft';

    public const REVIEW_PENDING_ADMIN = 'menunggu_admin';

    public const REVIEW_NEEDS_CHANGES = 'perlu_perbaikan';

    public const REVIEW_PENDING_INSTANSI = 'menunggu_instansi';

    public const REVIEW_APPROVED = 'disetujui';

    public function isEditableByOwner(): bool
    {
        return in_array($this->review_status, [
            self::REVIEW_DRAFT,
            self::REVIEW_NEEDS_CHANGES,
        ], true);
    }

    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi', 'id_instansi');
    }

    public function pelayanan()
    {
        return $this->belongsToMany(Pelayanan::class, 'pelayanan_sk', 'sk_id', 'pelayanan_id')
            ->withTimestamps();
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
