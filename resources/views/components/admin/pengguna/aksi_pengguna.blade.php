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

        @if ($pengguna->nip_valid)
        <a href="{{ route('admin.tanda_tangan.index', ['nip' => $pengguna->nip]) }}"
            class="dt-icon-btn edit" title="Kelola tanda tangan">
                <i class="bi bi-pen"></i>
        </a>
        @else
            <span class="dt-icon-btn" style="color:#a7b1be; cursor:not-allowed;"
                title="NIP pejabat belum diisi/valid di profil instansi">
                <i class="bi bi-pen"></i>
            </span>
        @endif

        @if ($pengguna->email)
            <form action="{{ route('admin.pengguna.reset_password', $pengguna->id) }}" method="POST" class="d-inline"
                  data-confirm
                  data-confirm-type="primary"
                  data-confirm-title="Atur Ulang Password?"
                  data-confirm-text="Password baru akan dibuat dan dikirim ke email pengguna ini."
                  data-confirm-button="Ya, Kirim">
                @csrf
                <button type="submit" class="dt-icon-btn info" title="Kirim password baru ke email">
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