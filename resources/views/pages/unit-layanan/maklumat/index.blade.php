@extends('layouts.unit-layanan')

@section('title', 'Maklumat')

@section('content')

<div class="maklumat-page">

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="d-flex justify-content-between align-items-start maklumat-page-header">
        <div>
            <h1 class="maklumat-page-title">
                Informasi Data Maklumat
            </h1>

            <p class="maklumat-page-subtitle">
                Informasi data Maklumat yang terdapat dalam masing-masing dinas.
            </p>
        </div>

    </div>

    {{-- =====================================================
         TABLE
    ====================================================== --}}

    <x-unit-layanan.maklumat.table :maklumat-list="$maklumatList" />

</div>

@endsection


{{-- =========================================================
     STYLE
========================================================= --}}

@push('styles')

    @include('pages.unit-layanan.maklumat._styles')

@endpush


{{-- =========================================================
     SCRIPT
========================================================= --}}

@push('scripts')

    @include('pages.unit-layanan.maklumat._scripts')

@endpush