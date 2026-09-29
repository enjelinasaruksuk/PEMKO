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
    @if (in_array($pengguna->peran, ['Instansi Level 1', 'Unit Layanan Level 2'], true) && $pengguna->email)
        <form action="{{ route('admin.pengguna.reset_password', $pengguna->id) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="dt-icon-btn info" title="Kirim password baru ke email"
                    onclick="return confirm('Atur ulang password dan kirim ke email pengguna ini?')">
                <i class="bi bi-arrow-repeat"></i>
            </button>
        </form>
    @endif
    <form action="{{ Route::has('admin.pengguna.toggle_status') ? route('admin.pengguna.toggle_status', $pengguna->id) : '#' }}" method="POST" class="d-inline">
        @csrf
        @method('PUT')
        <button type="submit" class="dt-icon-btn status" title="{{ $pengguna->status === 'Aktif' ? 'Nonaktifkan Akun' : 'Aktifkan Akun' }}">
            <i class="bi bi-record-circle"></i>
        </button>
    </form>
    <button type="button" class="dt-icon-btn delete" data-bs-toggle="modal"
            data-bs-target="#modalHapusPengguna{{ $pengguna->id }}" title="Hapus">
        <i class="bi bi-trash"></i>
    </button>
</div>