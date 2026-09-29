@extends($layout ?? 'layouts.unit-layanan')

@section('title', 'Detail Layanan')

@section('content')
@php
    $fields = [
        'Penyampaian Layanan' => [
            'persyaratan' => 'Persyaratan',
            'sistem_mekanisme_prosedur' => 'Sistem, Mekanisme dan Prosedur',
            'jangka_waktu' => 'Jangka Waktu Pelayanan',
            'biaya' => 'Biaya',
            'produk_pelayanan' => 'Produk Pelayanan',
            'penanganan_pengaduan' => 'Penanganan, Pengaduan, Saran dan Masukan',
        ],
        'Pengelolaan Pelayanan' => [
            'dasar_hukum' => 'Dasar Hukum',
            'sarana_prasarana' => 'Sarana dan Prasarana dan/atau Fasilitas',
            'kompetensi_pelaksana' => 'Kompetensi Pelaksana',
            'pengawasan_internal' => 'Pengawasan Internal',
            'jumlah_pelaksana' => 'Jumlah Pelaksana',
            'jaminan_pelayanan' => 'Jaminan Pelayanan',
            'jaminan_keamanan' => 'Jaminan Keamanan dan Keselamatan Pelayanan',
            'evaluasi_kinerja' => 'Evaluasi Kinerja Pelaksana',
        ],
    ];
    $clean = fn ($html) => strip_tags($html ?? '', '<p><br><ul><ol><li><strong><b><em><i><u>');
@endphp
<div class="d-flex justify-content-between align-items-start mb-3">
    <div>
        <h1 class="page-title mb-1">Detail Informasi Layanan</h1>
        <p class="page-description mb-0">{{ $pelayanan->nama_layanan }}</p>
    </div>
    <a href="{{ url()->previous() }}" class="btn btn-light btn-sm rounded-pill px-3">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="card-custom p-4 mb-4">
    <h2 class="section-title">Nama Layanan</h2>
    <p class="mb-0">{{ $pelayanan->nama_layanan }}</p>
</div>
@foreach ($fields as $section => $items)
<div class="card-custom p-4 mb-4">
    <h2 class="section-title mb-3">{{ $section }}</h2>
    <dl class="row mb-0">
        @foreach ($items as $field => $label)
        <dt class="col-md-4 mb-2">{{ $label }}</dt>
        <dd class="col-md-8 mb-3">{!! $clean($pelayanan->$field) ?: '-' !!}</dd>
        @endforeach
    </dl>
</div>
@endforeach
@endsection
