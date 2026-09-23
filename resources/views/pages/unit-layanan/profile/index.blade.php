@extends('layouts.unit-layanan')

@section('title', 'Profil Unit Layanan')

@section('content')

<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h1 class="page-title mb-1">Profil Unit Layanan</h1>
        <p class="page-description mb-0">Informasi profil unit layanan.</p>
    </div>
</div>


{{-- ACTION BUTTON --}}
<div class="d-flex justify-content-end gap-2 mb-4">

    <button type="button" class="btn-primary-custom" data-bs-toggle="modal" data-bs-target="#createProfileModal">
        <i class="bi bi-plus-circle me-1"></i>
        Tambah Data
    </button>

    <a href="{{ route('unit_layanan.profile.regulations') }}" class="btn-primary-custom text-decoration-none">
        <i class="bi bi-file-earmark-text me-1"></i>
        Tambah Perda & Perwali
    </a>

</div>


{{-- DATA PROFIL --}}
@if(isset($profile) && $profile)

<div class="card-custom p-4">

    <h5 class="section-title text-start mb-4">Data Profil Unit Layanan</h5>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="profile-item">
                <div class="profile-label">Nama Unit Layanan</div>
                <div class="profile-value">{{ $profile->nama_unit ?? '-' }}</div>
            </div>
            <div class="profile-item">
                <div class="profile-label">Nama Kepala Dinas/UUP</div>
                <div class="profile-value">{{ $profile->nama_kepala ?? '-' }}</div>
            </div>
            <div class="profile-item">
                <div class="profile-label">Jabatan</div>
                <div class="profile-value">{{ $profile->jabatan ?? '-' }}</div>
            </div>
            <div class="profile-item">
                <div class="profile-label">Laman (Website)</div>
                <div class="profile-value">{{ $profile->website ?? '-' }}</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="profile-item">
                <div class="profile-label">Alamat</div>
                <div class="profile-value">{{ $profile->alamat ?? '-' }}</div>
            </div>
            <div class="profile-item">
                <div class="profile-label">NIP</div>
                <div class="profile-value">{{ $profile->nip ?? '-' }}</div>
            </div>
            <div class="profile-item">
                <div class="profile-label">Pangkat</div>
                <div class="profile-value">{{ $profile->pangkat ?? '-' }}</div>
            </div>
            <div class="profile-item">
                <div class="profile-label">Email</div>
                <div class="profile-value">{{ $profile->email ?? '-' }}</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="profile-item">
                <div class="profile-label">Telepon</div>
                <div class="profile-value">{{ $profile->telepon ?? '-' }}</div>
            </div>
            <div class="profile-item">
                <div class="profile-label">Faksimile</div>
                <div class="profile-value">{{ $profile->faksimile ?? '-' }}</div>
            </div>
            <div class="profile-item">
                <div class="profile-label">Motto</div>
                <div class="profile-value">{{ $profile->motto ?? '-' }}</div>
            </div>
            <div class="profile-item">
                <div class="profile-label">Visi</div>
                <div class="profile-value">{{ $profile->visi ?? '-' }}</div>
            </div>
        </div>

    </div>


    @if ($perdaList->isNotEmpty())
        <div class="profile-item mt-2">
            <div class="profile-label">Perda</div>
            @foreach ($perdaList as $i => $item)
                <div class="profile-value">{{ $i + 1 }}. {{ $item->tentang }}</div>
            @endforeach
        </div>
    @endif


    @if ($perwaliList->isNotEmpty())
        <div class="profile-item mt-2">
            <div class="profile-label">Perwali</div>
            @foreach ($perwaliList as $i => $item)
                <div class="profile-value">{{ $i + 1 }}. {{ $item->tentang }}</div>
            @endforeach
        </div>
    @endif


    <div class="d-flex justify-content-end mt-3">
        <button type="button" class="btn-primary-custom" data-bs-toggle="modal" data-bs-target="#createProfileModal">
            <i class="bi bi-pencil me-1"></i>
            Ubah Data
        </button>
    </div>

</div>

@else

<div class="card-custom empty-profile">
    <div class="empty-icon">
        <i class="bi bi-person-vcard"></i>
    </div>
    <h5>Belum Ada Data Profil</h5>
    <p>Silakan tambahkan data profil unit layanan terlebih dahulu.</p>
</div>

@endif


<x-unit-layanan.profile.modal-profile :profile="$profile ?? null" />


@if (session('success_modal'))
<div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-4">
                <div class="delete-warning-icon" style="background: rgba(25,135,84,.1); color:#198754;">
                    <i class="bi bi-check-circle"></i>
                </div>
                <h5 class="delete-modal-title">Berhasil!</h5>
                <p class="delete-modal-text">{{ session('success_modal') }}</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn-primary-custom" data-bs-dismiss="modal">Oke, Mengerti</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new bootstrap.Modal(document.getElementById('successModal')).show();
    });
</script>
@endpush
@endif

@endsection