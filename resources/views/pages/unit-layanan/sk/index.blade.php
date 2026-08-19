@extends('layouts.unit-layanan')

@section('title', 'Pengesahan SK')

@section('content')

<div class="sk-page">

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="sk-page-header">

        <div>

            <h1 class="sk-page-title">
                Pengesahan SK
            </h1>

            <p class="sk-page-subtitle">
                Informasi data SK yang terdapat dalam masing-masing bagian organisasi.
            </p>

        </div>

    </div>


    {{-- =====================================================
         MAIN CARD
    ====================================================== --}}

    <div class="sk-main-card">

        {{-- ORGANISASI --}}

        <div class="sk-organization-header">

            <div class="sk-organization-title">

                <span class="sk-organization-icon">
                    <i class="bi bi-building"></i>
                </span>

                <span>
                    Bagian Organisasi
                </span>

            </div>


            <button
                type="button"
                class="sk-chevron-button"
                aria-label="Buka atau tutup data"
            >

                <i class="bi bi-chevron-down"></i>

            </button>

        </div>


        <div class="sk-divider"></div>


        {{-- DATA SK --}}

        <div class="sk-section-header">

            <div>

                <h2 class="sk-section-title">
                    Data SK
                </h2>

                <p class="sk-section-description">
                    Daftar Surat Keputusan Bagian Organisasi.
                </p>

            </div>


            <button
                type="button"
                class="sk-add-button"
                data-bs-toggle="modal"
                data-bs-target="#skModal"
            >

                <i class="bi bi-plus-circle"></i>

                <span>
                    Tambah SK
                </span>

            </button>

        </div>


        {{-- TABLE --}}

        @include('pages.unit-layanan.sk._table')

    </div>

</div>


{{-- =========================================================
     MODAL TAMBAH / EDIT
========================================================= --}}

@include('pages.unit-layanan.sk._modal-form')


{{-- =========================================================
     MODAL STATUS
========================================================= --}}

@include('pages.unit-layanan.sk._status-modal')


@endsection


{{-- =========================================================
     STYLE
========================================================= --}}

@push('styles')

    @include('pages.unit-layanan.sk._styles')

@endpush


{{-- =========================================================
     SCRIPT
========================================================= --}}

@push('scripts')

    @include('pages.unit-layanan.sk._scripts')

@endpush