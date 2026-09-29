@extends('layouts.instansi')
@section('title', 'SK Instansi')

@section('content')
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h1 class="page-title mb-1">Pengesahan SK Instansi</h1>
        <p class="page-description mb-0">Kelola SK milik instansi ini dan kirim draf ke Admin untuk diperiksa.</p>
    </div>
</div>

<div class="card-custom p-3 p-md-4 mb-4">
    <h2 class="section-title mb-3">Tambah SK</h2>
    <form method="POST" action="{{ route('instansi.own_sk.store') }}" class="row g-3 align-items-end">
        @csrf
        <div class="col-md-4">
            <label for="no_sk" class="form-label">Nomor SK</label>
            <input id="no_sk" name="no_sk" class="form-control" value="{{ old('no_sk') }}" required>
        </div>
        <div class="col-md-3">
            <label for="tanggal_sk" class="form-label">Tanggal SK</label>
            <input id="tanggal_sk" name="tanggal_sk" type="date" class="form-control" value="{{ old('tanggal_sk') }}" required>
        </div>
        <div class="col-md-3">
            <label for="jenis_sk" class="form-label">Jenis SK</label>
            <select id="jenis_sk" name="jenis_sk" class="form-select" required>
                <option value="SK Baru">SK Baru</option>
                <option value="Menggantikan SK Sebelumnya">Menggantikan SK Sebelumnya</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn-primary-custom w-100"><i class="bi bi-plus-circle me-1"></i> Tambah</button>
        </div>
        <div class="col-md-6">
            <label for="no_sk_sebelumnya" class="form-label">Nomor SK sebelumnya <span class="text-muted">(jika menggantikan)</span></label>
            <input id="no_sk_sebelumnya" name="no_sk_sebelumnya" class="form-control" value="{{ old('no_sk_sebelumnya') }}">
        </div>
    </form>
</div>

<div class="card-custom p-3 p-md-4">
    <h2 class="section-title mb-3">Daftar SK Instansi</h2>
    <div class="table-responsive">
        <table class="table table-custom table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor SK</th>
                    <th>Tanggal</th>
                    <th>Layanan</th>
                    <th>Proses</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($skList as $sk)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $sk->no_sk }}</td>
                    <td>{{ $sk->tanggal_sk?->format('d/m/Y') }}</td>
                    <td>{{ $sk->pelayanan_count }}</td>
                    <td>
                        @php
                            $labels = [
                                'draft' => 'Belum dikirim',
                                'menunggu_admin' => 'Menunggu Admin',
                                'perlu_perbaikan' => 'Perlu diperbaiki',
                                'menunggu_instansi' => 'Menunggu persetujuan',
                                'disetujui' => 'Sudah disetujui',
                            ];
                        @endphp
                        {{ $labels[$sk->review_status] ?? 'Belum dikirim' }}
                        @if ($sk->review_status === 'perlu_perbaikan' && $sk->review_comment)
                            <div class="small text-danger mt-1">{{ $sk->review_comment }}</div>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('instansi.own_sk.layanan', $sk) }}" class="icon-action-btn view" title="Kelola layanan">
                                <i class="bi bi-clipboard"></i>
                            </a>
                            @if ($sk->isEditableByOwner())
                                <button type="button" class="icon-action-btn edit" title="Edit nomor atau tanggal"
                                        data-bs-toggle="modal" data-bs-target="#editOwnSk{{ $sk->id }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form method="POST" action="{{ route('instansi.own_sk.destroy', $sk) }}"
                                      onsubmit="return confirm('Hapus SK ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="icon-action-btn delete" title="Hapus SK"><i class="bi bi-trash"></i></button>
                                </form>
                                @if ($sk->status === 'Aktif' && $sk->pelayanan_count > 0)
                                    <form method="POST" action="{{ route('instansi.own_sk.submit', $sk) }}"
                                          onsubmit="return confirm('Kirim SK ke Admin untuk diperiksa?')">
                                        @csrf
                                        <button type="submit" class="icon-action-btn text-success" title="Kirim ke Admin">
                                            <i class="bi bi-send"></i>
                                        </button>
                                    </form>
                                @endif
                            @endif
                            @if ($sk->review_status === 'menunggu_instansi')
                                <form method="POST" action="{{ route('instansi.own_sk.approve', $sk) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status_approval" value="disetujui">
                                    <button type="submit" class="icon-action-btn text-success" title="Setujui SK">
                                        <i class="bi bi-check-circle"></i>
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('instansi.own_sk.approve', $sk) }}"
                                      onsubmit="return confirm('Kembalikan SK ini untuk diperbaiki?')">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status_approval" value="ditolak">
                                    <button type="submit" class="icon-action-btn delete" title="Kembalikan untuk diperbaiki">
                                        <i class="bi bi-arrow-return-left"></i>
                                    </button>
                                </form>
                            @endif
                            @if ($sk->review_status === 'disetujui')
                                <a href="{{ route('pdf.sk', $sk) }}" target="_blank" class="icon-action-btn text-danger" title="Cetak SK">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                </a>
                            @endif
                        </div>
                        @if ($sk->isEditableByOwner())
                        <div class="modal fade" id="editOwnSk{{ $sk->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('instansi.own_sk.update', $sk) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header"><h5 class="modal-title">Edit SK</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                        <div class="modal-body">
                                            <label class="form-label">Nomor SK</label>
                                            <input name="no_sk" class="form-control mb-3" value="{{ $sk->no_sk }}" required>
                                            <label class="form-label">Tanggal SK</label>
                                            <input name="tanggal_sk" type="date" class="form-control mb-3" value="{{ $sk->tanggal_sk?->format('Y-m-d') }}" required>
                                            <label class="form-label">Jenis SK</label>
                                            <select name="jenis_sk" class="form-select mb-3" required>
                                                <option value="SK Baru" @selected($sk->jenis_sk === 'SK Baru')>SK Baru</option>
                                                <option value="Menggantikan SK Sebelumnya" @selected($sk->jenis_sk === 'Menggantikan SK Sebelumnya')>Menggantikan SK Sebelumnya</option>
                                            </select>
                                            <label class="form-label">Nomor SK sebelumnya</label>
                                            <input name="no_sk_sebelumnya" class="form-control" value="{{ $sk->no_sk_sebelumnya }}">
                                        </div>
                                        <div class="modal-footer"><button type="submit" class="btn-primary-custom">Simpan</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Belum ada SK Instansi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
