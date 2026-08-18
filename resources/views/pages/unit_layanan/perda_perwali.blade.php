@extends('layouts.pengguna')
@section('title', 'Perda & Perwali')

@section('content')
    {{-- ============ TABEL PERDA ============ --}}
    <div class="d-flex justify-content-between align-items-start mb-2">
        <div>
            <h5 class="fw-bold text-primary mb-1">Perda - {{ $namaUnit ?? 'Sekretariat Daerah' }}</h5>
            <p class="text-muted small mb-0">Silahkan isi form dibawah ini untuk merubah profil unit layanan anda</p>
        </div>
        <button type="button" class="btn btn-primary btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#modalTambahPerda">
            <i class="bi bi-plus-circle"></i> Tambah Perda
        </button>
    </div>

    <div class="bg-white rounded shadow-sm p-3 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <div class="d-flex align-items-center gap-2">
                <span class="small">Show</span>
                <select class="form-select form-select-sm w-auto"><option>10</option></select>
                <span class="small">entries</span>
            </div>
            <input type="text" class="form-control form-control-sm w-auto" placeholder="Search...">
        </div>

        <table class="table align-middle">
            <thead>
                <tr class="bg-light">
                    <th style="width:40px">No</th>
                    <th>Perda</th>
                    <th style="width:160px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($perdaList ?? [] as $i => $perda)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="text-primary">{{ $perda->tentang }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditPerda{{ $perda->id }}">Edit</button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapusPerda{{ $perda->id }}">Hapus</button>
                            </div>
                        </td>
                    </tr>
                    <x-perda.modal_edit :perda="$perda" />
                @empty
                    <tr><td colspan="3" class="text-center text-muted py-3">Belum ada data Perda.</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center gap-2">
            <button class="btn btn-sm btn-light">«</button>
            <button class="btn btn-sm btn-primary">1</button>
            <button class="btn btn-sm btn-light">»</button>
        </div>
    </div>

    {{-- ============ TABEL PERWALI ============ --}}
    <div class="d-flex justify-content-between align-items-start mb-2">
        <div>
            <h5 class="fw-bold text-primary mb-1">Perwali - {{ $namaUnit ?? 'Sekretariat Daerah' }}</h5>
            <p class="text-muted small mb-0">Silahkan isi form dibawah ini untuk merubah profil unit layanan anda</p>
        </div>
        <button type="button" class="btn btn-primary btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#modalTambahPerwali">
            <i class="bi bi-plus-circle"></i> Tambah Perwali
        </button>
    </div>

    <div class="bg-white rounded shadow-sm p-3">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <div class="d-flex align-items-center gap-2">
                <span class="small">Show</span>
                <select class="form-select form-select-sm w-auto"><option>10</option></select>
                <span class="small">entries</span>
            </div>
            <input type="text" class="form-control form-control-sm w-auto" placeholder="Search...">
        </div>

        <table class="table align-middle">
            <thead>
                <tr class="bg-light">
                    <th style="width:40px">No</th>
                    <th>Perwali</th>
                    <th style="width:160px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($perwaliList ?? [] as $i => $perwali)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="text-primary">{{ $perwali->tentang }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditPerwali{{ $perwali->id }}">Edit</button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapusPerwali{{ $perwali->id }}">Hapus</button>
                            </div>
                        </td>
                    </tr>
                    <x-perwali.modal_edit :perwali="$perwali" />
                @empty
                    <tr><td colspan="3" class="text-center text-muted py-3">Belum ada data Perwali.</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center gap-2">
            <button class="btn btn-sm btn-light">«</button>
            <button class="btn btn-sm btn-primary">1</button>
            <button class="btn btn-sm btn-light">»</button>
        </div>
    </div>

    {{-- Modal tambah cukup sekali per jenis --}}
    <x-perda.modal_tambah />
    <x-perwali.modal_tambah />
@endsection