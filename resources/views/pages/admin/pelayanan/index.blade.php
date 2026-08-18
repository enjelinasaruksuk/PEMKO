@extends('layouts.admin')
@section('title', 'Komponen Pelayanan')

@section('content')
    <x-breadcrumb :items="['Dashboard']" title="Komponen Pelayanan" />

   <x-admin.filter_bar modal-target="#modalTambahKomponen" />

    <div class="bg-white rounded shadow-sm p-3">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <small class="text-muted">Showing {{ count($komponenList ?? []) }} of 10 projects</small>
            <div class="dropdown">
                <button class="btn btn-sm btn-light border dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Filter
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Penyampaian</a></li>
                    <li><a class="dropdown-item" href="#">Pengelolaan</a></li>
                </ul>
            </div>
        </div>

        <table class="table align-middle">
            <thead>
                <tr class="bg-light">
                    <th style="width:50px">No</th>
                    <th>Nama Komponen</th>
                    <th>Kategori</th>
                    <th style="width:160px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($komponenList ?? [] as $i => $komponen)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="text-primary">{{ $komponen->nama_komponen }}</td>
                        <td>{{ $komponen->kategori }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#modalEditKomponen{{ $komponen->id }}">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-danger btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#modalHapusKomponen{{ $komponen->id }}">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    <x-admin.pelayanan.modal_edit_komponen :komponen="$komponen" />
                    <x-admin.pelayanan.modal_hapus_komponen :komponen="$komponen" />
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-3">Belum ada data komponen.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <x-admin.pelayanan.modal_tambah_komponen />
@endsection