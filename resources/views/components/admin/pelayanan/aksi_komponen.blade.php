@props(['komponen'])

<div class="dt-actions">
    <button type="button" class="dt-icon-btn edit" data-bs-toggle="modal"
            data-bs-target="#modalEditKomponen{{ $komponen->id_komponen }}" title="Edit">
        <i class="bi bi-pencil"></i>
    </button>
    <button type="button" class="dt-icon-btn delete" data-bs-toggle="modal"
            data-bs-target="#modalHapusKomponen{{ $komponen->id_komponen }}" title="Hapus">
        <i class="bi bi-trash"></i>
    </button>
</div>