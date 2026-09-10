@extends('layouts.instansi')
@section('title', 'Perda & Perwali')

@section('content')

<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h1 class="page-title mb-1">Peraturan</h1>
        <p class="page-description mb-0">Data Peraturan Daerah dan Peraturan Wali Kota - {{ $namaUnit ?? 'Sekretariat Daerah' }}</p>
    </div>

    <a href="{{ route('instansi.profile') }}" class="btn btn-light">
        <i class="bi bi-arrow-left me-1"></i>
        Kembali
    </a>
</div>

<div class="d-flex justify-content-between align-items-start mb-3">
    <div>
        <h1 class="page-title mb-1">Peraturan Daerah</h1>
        <p class="page-description mb-0">Daftar Peraturan Daerah.</p>
    </div>
    <button type="button" class="btn-primary-custom" data-bs-toggle="modal" data-bs-target="#modalTambahPerda">
        <i class="bi bi-plus-circle me-1"></i> Tambah Perda
    </button>
</div>

<div class="card-custom p-3 mb-4">
    <div class="table-responsive">
        <table class="table table-custom mb-0">
            <thead>
                <tr>
                    <th style="width:50px;">No</th>
                    <th>Perda</th>
                    <th style="width:150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($perdaList ?? [] as $i => $perda)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $perda->tentang }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#modalEditPerda{{ $perda->id }}">Edit</button>
                                <button type="button" class="btn-action btn-delete" data-bs-toggle="modal" data-bs-target="#modalHapusPerda{{ $perda->id }}">Hapus</button>
                            </div>
                        </td>
                    </tr>
                    <x-instansi.perda_perwali.modal-edit-perda :perda="$perda" />
                    <x-instansi.perda_perwali.modal-hapus-perda :perda="$perda" />
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                            Belum ada data Perda.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-between align-items-start mb-3">
    <div>
        <h1 class="page-title mb-1">Peraturan Wali Kota</h1>
        <p class="page-description mb-0">Daftar Peraturan Wali Kota - {{ $namaUnit ?? 'Sekretariat Daerah' }}</p>
    </div>
    <button type="button" class="btn-primary-custom" data-bs-toggle="modal" data-bs-target="#modalTambahPerwali">
        <i class="bi bi-plus-circle me-1"></i> Tambah Perwali
    </button>
</div>

<div class="card-custom p-3">
    <div class="table-responsive">
        <table class="table table-custom mb-0">
            <thead>
                <tr>
                    <th style="width:50px;">No</th>
                    <th>Perwali</th>
                    <th style="width:150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($perwaliList ?? [] as $i => $perwali)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $perwali->tentang }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#modalEditPerwali{{ $perwali->id }}">Edit</button>
                                <button type="button" class="btn-action btn-delete" data-bs-toggle="modal" data-bs-target="#modalHapusPerwali{{ $perwali->id }}">Hapus</button>
                            </div>
                        </td>
                    </tr>
                    <x-instansi.perda_perwali.modal-edit-perwali :perwali="$perwali" />
                    <x-instansi.perda_perwali.modal-hapus-perwali :perwali="$perwali" />
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                            Belum ada data Perwali.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<x-instansi.perda_perwali.modal-tambah-perda />
<x-instansi.perda_perwali.modal-tambah-perwali />

@endsection