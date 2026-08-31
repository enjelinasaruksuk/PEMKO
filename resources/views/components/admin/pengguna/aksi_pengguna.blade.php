@props(['pengguna'])

<div class="dt-actions">
    <a href="{{ Route::has('admin.pengguna.show') ? route('admin.pengguna.show', $pengguna->id) : '#' }}"
       class="dt-icon-btn view" title="Lihat">
        <i class="bi bi-eye"></i>
    </a>
    <a href="{{ Route::has('admin.pengguna.edit') ? route('admin.pengguna.edit', $pengguna->id) : '#' }}"
       class="dt-icon-btn edit" title="Edit">
        <i class="bi bi-pencil"></i>
    </a>
    <a href="#" class="dt-icon-btn info" title="Reset Password">
        <i class="bi bi-arrow-repeat"></i>
    </a>
    <button type="button" class="dt-icon-btn delete" data-bs-toggle="modal"
            data-bs-target="#modalHapusPengguna{{ $pengguna->id }}" title="Hapus">
        <i class="bi bi-trash"></i>
    </button>
</div>