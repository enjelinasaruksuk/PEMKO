@extends('layouts.unit-layanan')

@section('title', 'Profil Unit Layanan')

@section('content')

<div class="d-flex justify-content-between align-items-start mb-4">

    <div>
        <h1 class="page-title mb-1">
            Profil Unit Layanan
        </h1>

        <p class="page-description mb-0">
            Informasi profil unit layanan.
        </p>
    </div>

</div>


{{-- ACTION BUTTON --}}
<div class="d-flex justify-content-end gap-2 mb-4">

    {{-- Tambah Data --}}
    <button
        type="button"
        class="btn-primary-custom"
        data-bs-toggle="modal"
        data-bs-target="#createProfileModal"
    >
        <i class="bi bi-plus-circle me-1"></i>
        Tambah Data
    </button>


    {{-- Perda & Perwali --}}
    <a
        href="{{ route('unit_layanan.profile.regulations') }}"
        class="btn-primary-custom text-decoration-none"
    >
        <i class="bi bi-file-earmark-text me-1"></i>
        Tambah Perda & Perwali
    </a>

</div>


{{-- DATA PROFIL --}}
@if(isset($profile) && $profile)

<div class="card-custom p-4">

    <h5 class="section-title text-start mb-4">
        Data Profil Unit Layanan
    </h5>


    <div class="row g-4">

        <div class="col-md-4">

            <div class="profile-item">

                <div class="profile-label">
                    Nama Unit Layanan
                </div>

                <div class="profile-value">
                    {{ $profile->nama_unit ?? '-' }}
                </div>

            </div>


            <div class="profile-item">

                <div class="profile-label">
                    Nama Kepala Dinas/UUP
                </div>

                <div class="profile-value">
                    {{ $profile->nama_kepala ?? '-' }}
                </div>

            </div>


            <div class="profile-item">

                <div class="profile-label">
                    Jabatan
                </div>

                <div class="profile-value">
                    {{ $profile->jabatan ?? '-' }}
                </div>

            </div>


            <div class="profile-item">

                <div class="profile-label">
                    Laman (Website)
                </div>

                <div class="profile-value">
                    {{ $profile->laman ?? '-' }}
                </div>

            </div>

        </div>


        <div class="col-md-4">

            <div class="profile-item">

                <div class="profile-label">
                    Alamat
                </div>

                <div class="profile-value">
                    {{ $profile->alamat ?? '-' }}
                </div>

            </div>


            <div class="profile-item">

                <div class="profile-label">
                    NIP
                </div>

                <div class="profile-value">
                    {{ $profile->nip ?? '-' }}
                </div>

            </div>


            <div class="profile-item">

                <div class="profile-label">
                    Pangkat
                </div>

                <div class="profile-value">
                    {{ $profile->pangkat ?? '-' }}
                </div>

            </div>


            <div class="profile-item">

                <div class="profile-label">
                    Email
                </div>

                <div class="profile-value">
                    {{ $profile->email ?? '-' }}
                </div>

            </div>

        </div>


        <div class="col-md-4">

            <div class="profile-item">

                <div class="profile-label">
                    Telepon
                </div>

                <div class="profile-value">
                    {{ $profile->telepon ?? '-' }}
                </div>

            </div>


            <div class="profile-item">

                <div class="profile-label">
                    Faksimile
                </div>

                <div class="profile-value">
                    {{ $profile->faksimile ?? '-' }}
                </div>

            </div>


            <div class="profile-item">

                <div class="profile-label">
                    Motto
                </div>

                <div class="profile-value">
                    {{ $profile->motto ?? '-' }}
                </div>

            </div>

        </div>

    </div>


    <div class="d-flex justify-content-end mt-3">

        <button
            type="button"
            class="btn-primary-custom"
            data-bs-toggle="modal"
            data-bs-target="#createProfileModal"
        >
            <i class="bi bi-pencil me-1"></i>
            Ubah Data
        </button>

    </div>

</div>

@else

{{-- EMPTY STATE --}}
<div class="card-custom empty-profile">

    <div class="empty-icon">

        <i class="bi bi-person-vcard"></i>

    </div>

    <h5>
        Belum Ada Data Profil
    </h5>

    <p>
        Silakan tambahkan data profil unit layanan terlebih dahulu.
    </p>

</div>

@endif


{{-- MODAL TAMBAH PROFILE --}}
@include(
    'pages.unit-layanan.profile.modals.create-profile'
)


@endsection


@push('styles')

<style>

    .empty-profile {
        min-height: 300px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .empty-icon {
        font-size: 45px;
        color: #2878d7;
        margin-bottom: 12px;
    }

    .empty-profile h5 {
        color: #173b69;
        font-size: 16px;
        margin-bottom: 6px;
    }

    .empty-profile p {
        color: #a5a9b2;
        font-size: 12px;
        margin-bottom: 0;
    }

    .profile-item {
        margin-bottom: 20px;
    }

    .profile-label {
        color: #173b69;
        font-size: 11px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .profile-value {
        color: #333;
        font-size: 13px;
        min-height: 20px;
    }

</style>

@endpush