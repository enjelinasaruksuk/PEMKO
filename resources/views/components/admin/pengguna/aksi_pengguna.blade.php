@props(['pengguna'])

<div class="dt-actions">
    <button type="button" class="dt-icon-btn view" data-bs-toggle="modal"
            data-bs-target="#modalDetailPengguna{{ $pengguna->id }}" title="Lihat">
        <i class="bi bi-eye"></i>
    </button>

    @if ($pengguna->can_manage)
        <button type="button" class="dt-icon-btn edit" data-bs-toggle="modal"
                data-bs-target="#modalEditPengguna{{ $pengguna->id }}" title="Edit">
            <i class="bi bi-pencil"></i>
        </button>

        @if ($pengguna->email)
            <form action="{{ route('admin.pengguna.reset_password', $pengguna->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="dt-icon-btn info" title="Kirim password baru ke email"
                        onclick="return confirm('Atur ulang password dan kirim ke email pengguna ini?')">
                    <i class="bi bi-arrow-repeat"></i>
                </button>
            </form>
        @endif
    @endif

    @if (in_array($pengguna->status_raw, ['aktif', 'nonaktif'], true) && ! $pengguna->is_self)
        <form action="{{ route('admin.pengguna.toggle_status', $pengguna->id) }}" method="POST" class="d-inline">
            @csrf
            @method('PUT')
            <button type="submit" class="dt-icon-btn status"
                    title="{{ $pengguna->status_raw === 'aktif' ? 'Nonaktifkan Akun' : 'Aktifkan Akun' }}">
                <i class="bi bi-record-circle"></i>
            </button>
        </form>
    @endif

    @unless ($pengguna->is_self)
        <button type="button" class="dt-icon-btn delete" data-bs-toggle="modal"
                data-bs-target="#modalHapusPengguna{{ $pengguna->id }}" title="Hapus">
            <i class="bi bi-trash"></i>
        </button>
    @endunless
</div>