@extends('layouts.instansi')
@section('title', 'Maklumat')

@section('content')
<div class="dt-page">
    <div class="dt-page-header">
        <p class="page-description mb-1">Dashboard / Maklumat</p>
        <h1 class="dt-page-title">Maklumat</h1>
        <p class="dt-page-subtitle">Maklumat pelayanan instansi yang berlaku saat ini.</p>
    </div>

    <x-instansi.maklumat.table :maklumat-list="$maklumatList" />
</div>

<x-instansi.maklumat.modal-tambah />
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/data-table.css') }}">
@endpush