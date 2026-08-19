@extends('layouts.unit-layanan')

@section('title', 'Edit SK')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h1 class="page-title">
                Pengesahan SK
            </h1>

            <p class="page-description">
                Informasi data SK yang terdapat dalam masing-masing bagian organisasi.
            </p>

        </div>

    </div>


    <div class="card-custom p-4">

        <p class="text-muted mb-0">
            Form edit SK sekarang menggunakan modal pada halaman Pengesahan SK.
        </p>


        <div class="mt-3">

            <a
                href="{{ route('unit_layanan.sk.index') }}"
                class="btn-primary-custom"
            >
                Kembali ke Pengesahan SK
            </a>

        </div>

    </div>

</div>

@endsection