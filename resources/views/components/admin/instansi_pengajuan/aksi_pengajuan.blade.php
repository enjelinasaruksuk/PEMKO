@props(['pengajuan'])

<div class="dt-actions">
    @if ($pengajuan->status === 'pending')
        <button type="button" class="dt-icon-btn edit" data-bs-toggle="modal"
                data-bs-target="#modalPengajuan{{ $pengajuan->id }}" title="Proses Pengajuan">
            <i class="bi bi-pencil"></i>
        </button>
    @else
        <button type="button" class="dt-icon-btn delete" title="Hapus">
            <i class="bi bi-trash"></i>
        </button>
    @endif
</div>