@extends('layouts.unit-layanan')

@section('title', 'Peraturan')

@section('content')

<div class="d-flex justify-content-between align-items-start mb-4">

    <div>
        <h1 class="page-title mb-1">
            Peraturan
        </h1>

        <p class="page-description mb-0">
            Data Peraturan Daerah dan Peraturan Wali Kota.
        </p>
    </div>

    <a
        href="{{ route('unit_layanan.profile') }}"
        class="btn btn-light"
    >
        <i class="bi bi-arrow-left me-1"></i>
        Kembali
    </a>

</div>


{{-- =========================================================
     PERATURAN DAERAH
========================================================= --}}

<div class="card-custom p-4 mb-4">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>
            <h2 class="page-title mb-1">
                Peraturan Daerah
            </h2>

            <p class="page-description mb-0">
                Daftar Peraturan Daerah.
            </p>
        </div>

        <button
            type="button"
            class="btn-primary-custom"
            data-bs-toggle="modal"
            data-bs-target="#tambahPerdaModal"
        >
            <i class="bi bi-plus-circle me-1"></i>
            Tambah Perda
        </button>

    </div>


    {{-- Data Perda --}}

    @forelse(($perda ?? []) as $item)

        <div class="border rounded p-3 mb-2">

            <div class="d-flex align-items-center gap-2">

                <i class="bi bi-file-earmark-text"></i>

                <span>
                    {{ $item }}
                </span>

            </div>

        </div>

    @empty

        <div class="text-center text-muted py-4">

            <i class="bi bi-file-earmark-text fs-3"></i>

            <div class="small mt-2">
                Belum ada Peraturan Daerah.
            </div>

        </div>

    @endforelse

</div>



{{-- =========================================================
     PERATURAN WALI KOTA
========================================================= --}}

<div class="card-custom p-4">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>
            <h2 class="page-title mb-1">
                Peraturan Wali Kota
            </h2>

            <p class="page-description mb-0">
                Daftar Peraturan Wali Kota.
            </p>
        </div>

        <button
            type="button"
            class="btn-primary-custom"
            data-bs-toggle="modal"
            data-bs-target="#tambahPerwaliModal"
        >
            <i class="bi bi-plus-circle me-1"></i>
            Tambah Perwali
        </button>

    </div>


    {{-- Data Perwali --}}

    @forelse(($perwali ?? []) as $item)

        <div class="border rounded p-3 mb-2">

            <div class="d-flex align-items-center gap-2">

                <i class="bi bi-file-earmark-text"></i>

                <span>
                    {{ $item }}
                </span>

            </div>

        </div>

    @empty

        <div class="text-center text-muted py-4">

            <i class="bi bi-file-earmark-text fs-3"></i>

            <div class="small mt-2">
                Belum ada Peraturan Wali Kota.
            </div>

        </div>

    @endforelse

</div>

   <x-unit-layanan.profile.modal-perda />
   <x-unit-layanan.profile.modal-perwali />

@endsection