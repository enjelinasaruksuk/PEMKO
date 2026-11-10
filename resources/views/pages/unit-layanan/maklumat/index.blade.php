@extends('layouts.unit-layanan')
@section('title', 'Maklumat')

@section('content')
<div class="dt-page">
    <div class="dt-page-header">
        <h1 class="dt-page-title">Informasi Data Maklumat</h1>
        <p class="dt-page-subtitle">Maklumat pelayanan dari instansi induk.</p>
    </div>

    <x-unit-layanan.maklumat.table :maklumat-list="$maklumatList" />
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/data-table.css') }}">
@endpush