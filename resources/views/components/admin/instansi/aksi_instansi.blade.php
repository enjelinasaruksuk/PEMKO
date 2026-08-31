@props(['instansi'])

<div class="dt-actions d-flex justify-content-center align-items-center gap-2">
    <button type="button" class="dt-icon-btn edit" data-bs-toggle="modal"
            data-bs-target="#modalEditInstansi{{ $instansi->id }}" title="Edit">
        <i class="bi bi-pencil"></i>
    </button>

    <button type="button" class="dt-icon-btn delete" data-bs-toggle="modal"
            data-bs-target="#modalHapusInstansi{{ $instansi->id }}" title="Hapus">
        <i class="bi bi-trash"></i>
    </button>
</div>