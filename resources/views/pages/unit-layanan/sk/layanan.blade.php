@extends($layout ?? 'layouts.unit-layanan')

@section('title', 'Layanan pada SK ' . $sk->no_sk)

@section('content')
<div>
    <div class="d-flex justify-content-between align-items-start gap-3 mb-4">
        <div>
            <h1 class="page-title mb-1">{{ $namaPemilik ?? ($sk->instansi?->nama_instansi ?? 'Unit Layanan') }}</h1>
            <p class="page-description mb-0">
                Kelola layanan untuk SK nomor {{ $sk->no_sk }}.
            </p>
        </div>
        <a href="{{ route(($skRoutePrefix ?? 'unit_layanan.sk').'.index') }}" class="btn btn-light btn-sm rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    @php($canManage = $sk->status === 'Aktif' && $sk->isEditableByOwner())

    @php($canManage = $sk->status === 'Aktif' && $sk->isEditableByOwner())

    @php($canManage = $sk->status === 'Aktif' && $sk->isEditableByOwner())

    @if ($canManage && $layananTerpilih->isNotEmpty())
    <div class="alert alert-warning d-flex align-items-start gap-3 mb-4 border-0 shadow-sm"
        role="alert"
        style="border-left: 4px solid #f5a900 !important; background: #fff8e6; color: #7a5600;">
        <i class="bi bi-exclamation-triangle-fill fs-5 flex-shrink-0" style="color:#f5a900;"></i>
        <div>
            <div class="fw-semibold mb-1">Jangan lupa kirim SK ke Admin</div>
            <div>
                Setelah menambahkan layanan dalam SK, harap kirim ke Admin di halaman sebelumnya
                (tombol <i class="bi bi-send"></i> pada daftar SK).
                <a href="{{ route(($skRoutePrefix ?? 'unit_layanan.sk').'.index') }}"
                class="fw-semibold text-decoration-underline" style="color:#7a5600;">
                    Kembali ke daftar SK
                </a>
            </div>
        </div>
    </div>
    @endif

    <section class="card-custom p-3 p-md-4 mb-4">
        <div class="mb-3">
            <div>
                <h2 class="section-title mb-1">Layanan dalam SK</h2>
                <p class="page-description mb-0">
                    Layanan yang tercatat pada SK nomor {{ $sk->no_sk }}.
                </p>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-custom table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width:60px">No</th>
                        <th>Nama Layanan</th>
                        <th class="d-none d-md-table-cell">Keterangan</th>
                        <th style="width:110px" class="text-center">Status</th>
                        <th style="width:140px" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($layananTerpilih as $layanan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $layanan->nama_layanan }}</td>
                        <td class="d-none d-md-table-cell">{{ \Illuminate\Support\Str::limit(strip_tags($layanan->persyaratan ?? ''), 100) ?: '-' }}</td>
                        <td class="text-center">
                            <span class="badge text-bg-{{ $sk->status === 'Aktif' ? 'success' : 'secondary' }}">
                                {{ $sk->status }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route(($pelayananRoutePrefix ?? 'unit_layanan.pelayanan').'.show', $layanan) }}"
                                   class="icon-action-btn edit" title="Lihat seluruh informasi layanan"
                                   aria-label="Lihat layanan {{ $layanan->nama_layanan }}">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @if ($canManage)
                                <form method="POST" action="{{ route(($skRoutePrefix ?? 'unit_layanan.sk').'.layanan.detach', [$sk, $layanan]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="icon-action-btn edit" title="Keluarkan dari SK"
                                            aria-label="Keluarkan {{ $layanan->nama_layanan }} dari SK">
                                        <i class="bi bi-dash-circle"></i>
                                    </button>
                                </form>
                                <form method="POST" action="{{ route(($skRoutePrefix ?? 'unit_layanan.sk').'.layanan.destroy', [$sk, $layanan]) }}"
                                      data-confirm
                                      data-confirm-title="Hapus Layanan?"
                                      data-confirm-text="Layanan &quot;{{ $layanan->nama_layanan }}&quot; akan dihapus permanen dan tidak dapat dikembalikan."
                                      data-confirm-button="Ya, Hapus">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="icon-action-btn delete" title="Hapus layanan"
                                            aria-label="Hapus layanan {{ $layanan->nama_layanan }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">Belum ada layanan yang dimasukkan ke SK ini.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <section class="card-custom p-3 p-md-4">
        <div class="mb-3">
            <div>
                <h2 class="section-title mb-1">Pilih Layanan</h2>
                <p class="page-description mb-0">Layanan yang belum tercatat pada SK aktif.</p>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-custom table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width:60px">No</th>
                        <th>Nama Layanan</th>
                        <th class="d-none d-md-table-cell">Keterangan</th>
                        <th style="width:110px" class="text-center">Status</th>
                        <th style="width:100px" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($layananTersedia as $layanan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $layanan->nama_layanan }}</td>
                        <td class="d-none d-md-table-cell">{{ \Illuminate\Support\Str::limit(strip_tags($layanan->persyaratan ?? ''), 100) ?: '-' }}</td>
                        <td class="text-center"><span class="badge text-bg-light text-dark">Tersedia</span></td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route(($pelayananRoutePrefix ?? 'unit_layanan.pelayanan').'.show', $layanan) }}"
                                   class="icon-action-btn edit" title="Lihat seluruh informasi layanan"
                                   aria-label="Lihat layanan {{ $layanan->nama_layanan }}">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @if ($canManage)
                                <form method="POST" action="{{ route(($skRoutePrefix ?? 'unit_layanan.sk').'.layanan.attach', [$sk, $layanan]) }}">
                                    @csrf
                                    <button type="submit" class="icon-action-btn text-success" title="Masukkan ke SK"
                                            aria-label="Masukkan {{ $layanan->nama_layanan }} ke SK">
                                        <i class="bi bi-check-circle"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">Semua layanan sudah tercatat pada SK.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection