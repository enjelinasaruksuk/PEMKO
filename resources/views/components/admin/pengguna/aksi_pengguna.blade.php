@props(['pengguna'])

<div class="d-flex gap-2">
    <a href="{{ Route::has('pengguna.show') ? route('pengguna.show', $pengguna->id) : '#' }}" class="text-dark" title="Lihat">
        <i class="bi bi-eye"></i>
    </a>
    <a href="{{ Route::has('pengguna.edit') ? route('pengguna.edit', $pengguna->id) : '#' }}" class="text-primary" title="Edit">
        <i class="bi bi-pencil-square"></i>
    </a>
    <a href="#" class="text-info" title="Reset Password">
        <i class="bi bi-arrow-repeat"></i>
    </a>
    <a href="#" class="text-dark" title="Detail">
        <i class="bi bi-record-circle"></i>
    </a>
    <button type="button" class="btn btn-link p-0 text-danger" data-bs-toggle="modal" data-bs-target="#modalHapusPengguna{{ $pengguna->id }}" title="Hapus">
        <i class="bi bi-trash"></i>
    </button>
</div>