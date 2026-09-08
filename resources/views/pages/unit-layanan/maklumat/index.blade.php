@extends('layouts.unit-layanan')

@section('title', 'Maklumat')

@section('content')

{{-- =========================================================
     DUMMY DATA — frontend dulu, nanti diganti data dari controller
========================================================= --}}
@php
    $maklumatList = collect([
        (object) [
            'id' => 1,
            'isi_maklumat' => 'Kami siap memberikan pelayanan sesuai dengan standar pelayanan, melakukan perbaikan secara terus menerus, dan apabila kami tidak memberikan pelayanan sesuai dengan standar pelayanan yang telah ditetapkan, kami siap menerima sanksi dan/atau memberikan kompensasi sesuai dengan peraturan perundang-undangan yang berlaku.',
            'nama_penjabat' => 'Otok Kuswandaru',
            'tanggal_input' => '2025-08-11',
        ],
    ]);
@endphp

<div class="maklumat-page">

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="maklumat-page-header">
        <h1 class="maklumat-page-title">
            Informasi Data Maklumat
        </h1>

        <p class="maklumat-page-subtitle">
            Informasi data Maklumat yang terdapat dalam masing-masing dinas.
        </p>
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