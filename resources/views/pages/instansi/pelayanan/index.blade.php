@extends('layouts.instansi')
@section('title', 'Nama Pelayanan')

@section('content')

<div class="d-flex justify-content-between align-items-start mb-3">
    <div>
        <h1 class="page-title mb-1">Informasi Layanan</h1>
        <p class="page-description mb-0">Informasi layanan yang tercatat pada Sekretariat Daerah</p>
    </div>

    <a href="{{ route('instansi.pelayanan.create') }}" class="btn-primary-custom text-decoration-none">
        <i class="bi bi-plus-circle me-1"></i> Tambah Data
    </a>
</div>

<div class="card-custom p-3">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="small">
            Show
            <select class="form-select form-select-sm d-inline-block" style="width:60px;">
                <option>10</option>
                <option>25</option>
                <option>50</option>
            </select>
            entries
        </div>

        <div class="input-group input-group-sm" style="max-width:220px;">
            <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
            <input type="text" class="form-control" placeholder="Search">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-custom mb-0">
            <thead>
                <tr>
                    <th style="width:50px;">No</th>
                    <th>Nama Layanan</th>
                    <th style="width:150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pelayananList ?? [] as $index => $pelayanan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $pelayanan['nama_layanan'] ?? '-' }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('instansi.pelayanan.edit', $pelayanan['id']) }}"
                                   class="btn-action btn-edit text-decoration-none">
                                    Edit
                                </a>

                                <button type="button" class="btn-action btn-delete"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        data-id="{{ $pelayanan['id'] }}"
                                        data-name="{{ $pelayanan['nama_layanan'] ?? 'data pelayanan ini' }}">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                            Belum ada data pelayanan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

<x-unit-layanan.pelayanan.modal-delete :base-url="url('instansi/pelayanan')" />

@endsection