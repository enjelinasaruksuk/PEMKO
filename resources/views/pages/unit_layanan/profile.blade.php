@extends('layouts.pengguna')
@section('title', 'Profile')

@section('content')
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div>
            <h5 class="fw-bold text-primary mb-1">Profil Unit Layanan - {{ $profile->nama_unit ?? 'Unit Layanan' }}</h5>
            <p class="text-muted small mb-0">Form profil unit layanan anda</p>
        </div>
        <a href="{{ Route::has('unit_layanan.perda_perwali.index') ? route('unit_layanan.perda_perwali.index') : '#' }}"
           class="btn btn-primary btn-sm rounded-pill px-3">
            <i class="bi bi-plus-circle"></i> Tambah Perda dan Perwali
        </a>
    </div>

    <div class="bg-white rounded shadow-sm p-4 mb-3" style="min-height: 80px;">
        @if ($profile)
            <div class="row">
                <div class="col-md-4"><strong>Kepala Dinas:</strong> {{ $profile->nama_kepala }}</div>
                <div class="col-md-4"><strong>Alamat:</strong> {{ $profile->alamat }}</div>
                <div class="col-md-4"><strong>Telepon:</strong> {{ $profile->telepon }}</div>
            </div>
        @else
            <p class="text-muted small mb-0">Belum ada data profil. Klik "Tambah Data" untuk mengisi.</p>
        @endif
    </div>

    <button type="button" class="btn btn-primary btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#modalTambahDataProfile">
        <i class="bi bi-plus-circle"></i> Tambah Data
    </button>

   <x-modal_profile_form :profile="$profile" update-route="unit_layanan.profile.update" />
@endsection