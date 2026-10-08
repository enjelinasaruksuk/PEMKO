@extends($layout ?? 'layouts.unit-layanan')

@section('title', 'Detail Layanan')

@section('content')
@php
    $clean = fn ($html) => strip_tags($html ?? '', '<p><br><ul><ol><li><strong><b><em><i><u>');
    $groupedDetails = $pelayanan->details->groupBy(fn ($d) => $d->komponen->kategori ?? '-');
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

@foreach (['Penyampaian' => 'PENYAMPAIAN LAYANAN', 'Pengelolaan' => 'PENGELOLAAN PELAYANAN'] as $kategori => $judulSection)
    @if (isset($groupedDetails[$kategori]) && $groupedDetails[$kategori]->isNotEmpty())
        <div class="card-custom p-4 mb-4">
            <h2 class="section-title mb-3">{{ $judulSection }}</h2>
            <dl class="row mb-0">
                @foreach ($groupedDetails[$kategori] as $detail)
                    <dt class="col-md-4 mb-2">{{ $detail->komponen->nama_komponen ?? '-' }}</dt>
                    <dd class="col-md-8 mb-3">{!! $clean($detail->isi_komponen) ?: '-' !!}</dd>
                @endforeach
            </dl>
        </div>
    @endif
@endforeach
@endsection