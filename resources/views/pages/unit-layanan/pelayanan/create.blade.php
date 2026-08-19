@extends('layouts.unit-layanan')

@section('title', 'Tambah Pelayanan')

@section('content')

<div class="d-flex justify-content-between align-items-start mb-3">

    <div>

        <h1 class="page-title mb-1">
            Informasi Layanan
        </h1>

        <p class="page-description mb-0">
            Informasi layanan yang tercatat pada Bagian Organisasi
        </p>

    </div>


    <a
        href="{{ route('unit_layanan.pelayanan.index') }}"
        class="btn btn-light btn-sm rounded-pill px-3"
    >

        <i class="bi bi-arrow-left me-1"></i>

        Kembali

    </a>

</div>


<form
    action="{{ route('unit_layanan.pelayanan.store') }}"
    method="POST"
>

    @csrf


    @include(
        'pages.unit-layanan.pelayanan._form'
    )


    <div class="d-flex justify-content-end gap-2 mb-4">

        <a
            href="{{ route('unit_layanan.pelayanan.index') }}"
            class="btn btn-light rounded-pill px-4"
        >
            Batal
        </a>


        <button
            type="submit"
            class="btn-primary-custom"
        >

            <i class="bi bi-save me-1"></i>

            Simpan

        </button>

    </div>

</form>

@endsection