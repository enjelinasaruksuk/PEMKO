@extends('layouts.instansi')
@section('title', 'Nama Unit Layanan')

@section('content')
<div class="dt-page">
    <div class="dt-page-header">
        <p class="page-description mb-1">Nama Unit Layanan</p>
        <h1 class="dt-page-title" style="font-size:22px;">Nama Unit Pelayanan</h1>
        <p class="dt-page-subtitle">Berikut data unit pelayanan (instansi level 2) di bawah instansi Anda.</p>
    </div>

    <x-instansi.unit_layanan.table :unit-layanan-list="$unitLayananList" />
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/data-table.css') }}">
@endpush