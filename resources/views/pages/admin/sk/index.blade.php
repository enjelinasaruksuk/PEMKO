@extends('layouts.admin')
@section('title', 'SK')

@section('content')
    <x-breadcrumb :items="['Dashboard']" title="SK" />

    <div class="bg-white rounded shadow-sm p-3">

        {{-- Toolbar: Show entries + Search --}}
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <div class="d-flex align-items-center gap-2">
                <span class="text-muted small">Show</span>
                <select class="form-select form-select-sm w-auto">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
                <span class="text-muted small">entries</span>
            </div>

            <div class="input-group w-auto">
                <input type="text" class="form-control form-control-sm" placeholder="Search">
                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr class="bg-light">
                        <th style="width:50px">No</th>
                        <th>Nama Dinas</th>
                        <th>No SK</th>
                        <th>Tanggal SK</th>
                        <th>Status</th>
                        <th class="text-center">Pengajuan SK (Kepala PD)</th>
                        <th>Konfirmasi</th>
                        <th style="width:120px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($skList ?? [] as $i => $sk)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $sk->nama_dinas }}</td>
                            <td>{{ $sk->no_sk }}</td>
                            <td>{{ $sk->tanggal_sk }}</td>
                            <td>
                                <span class="badge rounded-pill {{ $sk->status == 'Aktif' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $sk->status }}
                                </span>
                            </td>
                            <td class="text-center">
                                @if ($sk->sudah_diajukan)
                                    <i class="bi bi-check-square-fill text-primary" title="Sudah diajukan"></i>
                                @else
                                    <i class="bi bi-square text-muted" title="Belum diajukan"></i>
                                @endif
                            </td>
                            <td>
                                <button type="button"
                                        class="btn btn-sm border-0 d-flex align-items-center gap-1 {{ $sk->konfirmasi_status == 'disetujui' ? 'text-success' : 'text-warning' }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalKonfirmasiSk{{ $sk->id }}">
                                    @if ($sk->konfirmasi_status == 'disetujui')
                                        <i class="bi bi-check-circle-fill"></i> Sudah disetujui
                                    @else
                                        <i class="bi bi-clock-fill"></i> Belum disetujui
                                    @endif
                                </button>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="#" class="text-primary" title="Lihat">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                <a href="#" class="text-secondary" title="Print">
                                <i class="bi bi-printer"></i>
                                </a>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <x-admin.sk.modal_konfirmasi_sk :sk="$sk" />
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-3">Belum ada data SK.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination sederhana, sesuaikan dengan $skList->links() jika pakai paginate() --}}
        <div class="d-flex justify-content-center gap-2 mt-3">
            <button class="btn btn-sm btn-light border rounded-circle"><i class="bi bi-chevron-double-left"></i></button>
            <button class="btn btn-sm btn-light border rounded-circle"><i class="bi bi-chevron-left"></i></button>
            <button class="btn btn-sm btn-primary rounded-circle">1</button>
            <button class="btn btn-sm btn-light border rounded-circle"><i class="bi bi-chevron-right"></i></button>
            <button class="btn btn-sm btn-light border rounded-circle"><i class="bi bi-chevron-double-right"></i></button>
        </div>

    </div>
@endsection