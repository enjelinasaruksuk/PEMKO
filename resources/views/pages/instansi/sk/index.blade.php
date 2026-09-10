@extends('layouts.instansi')
@section('title', 'Pengesahan SK')

@section('content')
<div class="sk-page">

    <div class="sk-page-header">
        <h1 class="sk-page-title">Pengesahan SK</h1>
        <p class="sk-page-subtitle">Informasi data SK Sekretariat Daerah.</p>
    </div>

    <div class="sk-main-card">
        <div class="sk-section-header">
            <div>
                <h2 class="sk-section-title">Data SK</h2>
                <p class="sk-section-description">Daftar Surat Keputusan Sekretariat Daerah.</p>
            </div>

            <button type="button" class="sk-add-button" data-bs-toggle="modal" data-bs-target="#skModal">
                <i class="bi bi-plus-circle"></i>
                <span>Tambah SK</span>
            </button>
        </div>

        <x-instansi.sk.table :sk-list="$skList" />
    </div>
</div>

<x-instansi.sk.modal-form :sk-list="$skList" />
<x-instansi.sk.modal-delete />
<x-instansi.sk.modal-status />

@endsection

@push('styles')
    @include('pages.unit-layanan.sk._styles')
@endpush

@push('scripts')
    @include('pages.instansi.sk._scripts')
@endpush