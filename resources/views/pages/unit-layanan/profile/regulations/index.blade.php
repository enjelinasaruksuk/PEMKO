@extends('layouts.unit-layanan')

@section('title', 'Peraturan')

@section('content')

<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h1 class="page-title mb-1">Peraturan</h1>
        <p class="page-description mb-0">Data Peraturan Daerah dan Peraturan Wali Kota.</p>
    </div>

    <a href="{{ route('unit_layanan.profile') }}" class="btn btn-light">
        <i class="bi bi-arrow-left me-1"></i>
        Kembali
    </a>
</div>

{{-- =========================================================
     PERATURAN DAERAH
========================================================= --}}

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h2 class="page-title mb-1">Peraturan Daerah</h2>
        <p class="page-description mb-0">Daftar Peraturan Daerah.</p>
    </div>

    <button type="button" class="btn-primary-custom" data-bs-toggle="modal" data-bs-target="#tambahPerdaModal">
        <i class="bi bi-plus-circle me-1"></i>
        Tambah Perda
    </button>
</div>

<div class="card-custom p-3 mb-4">
    <div class="table-responsive">
        <table class="table table-custom mb-0">
            <thead>
                <tr>
                    <th style="width:50px;">No</th>
                    <th>Peraturan Daerah</th>
                    <th style="width:150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse (($perda ?? []) as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ is_object($item) ? $item->tentang : $item }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn-action btn-edit"
                                    data-bs-toggle="modal" data-bs-target="#editPerdaModal{{ is_object($item) ? $item->id : $i }}">
                                    Edit
                                </button>
                                <button type="button" class="btn-action btn-delete"
                                    data-bs-toggle="modal" data-bs-target="#hapusPerdaModal{{ is_object($item) ? $item->id : $i }}">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    <x-unit-layanan.profile.modal-edit-perda :perda="$item" :index="$i" />
                    <x-unit-layanan.profile.modal-hapus-perda :perda="$item" :index="$i" />
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-5">
                            <i class="bi bi-file-earmark-text fs-3 d-block mb-2"></i>
                            Belum ada Peraturan Daerah.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- =========================================================
     PERATURAN WALI KOTA
========================================================= --}}

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h2 class="page-title mb-1">Peraturan Wali Kota</h2>
        <p class="page-description mb-0">Daftar Peraturan Wali Kota.</p>
    </div>

    <button type="button" class="btn-primary-custom" data-bs-toggle="modal" data-bs-target="#tambahPerwaliModal">
        <i class="bi bi-plus-circle me-1"></i>
        Tambah Perwali
    </button>
</div>

<div class="card-custom p-3">
    <div class="table-responsive">
        <table class="table table-custom mb-0">
            <thead>
                <tr>
                    <th style="width:50px;">No</th>
                    <th>Peraturan Wali Kota</th>
                    <th style="width:150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse (($perwali ?? []) as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ is_object($item) ? $item->tentang : $item }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn-action btn-edit"
                                    data-bs-toggle="modal" data-bs-target="#editPerwaliModal{{ is_object($item) ? $item->id : $i }}">
                                    Edit
                                </button>
                                <button type="button" class="btn-action btn-delete"
                                    data-bs-toggle="modal" data-bs-target="#hapusPerwaliModal{{ is_object($item) ? $item->id : $i }}">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    <x-unit-layanan.profile.modal-edit-perwali :perwali="$item" :index="$i" />
                    <x-unit-layanan.profile.modal-hapus-perwali :perwali="$item" :index="$i" />
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-5">
                            <i class="bi bi-file-earmark-text fs-3 d-block mb-2"></i>
                            Belum ada Peraturan Wali Kota.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<x-unit-layanan.profile.modal-perda />
<x-unit-layanan.profile.modal-perwali />

@endsection