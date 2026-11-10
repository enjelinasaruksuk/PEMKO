@props(['instansi'])

<div class="dt-actions justify-content-center">
    <button type="button" class="dt-icon-btn edit" data-bs-toggle="modal"
            data-bs-target="#modalEditInstansi{{ $instansi->id_instansi }}" title="Edit">
        <i class="bi bi-pencil"></i>
    </button>

    <button type="button" class="dt-icon-btn delete" data-bs-toggle="modal"
            data-bs-target="#modalHapusInstansi{{ $instansi->id_instansi }}" title="Hapus">
        <i class="bi bi-trash"></i>
    </button>
</div>