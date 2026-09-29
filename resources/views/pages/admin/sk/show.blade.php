@extends('layouts.admin')
@section('title', 'Pemeriksaan SK')

@section('content')
@php
    $fields = [
        'persyaratan' => 'Persyaratan',
        'sistem_mekanisme_prosedur' => 'Sistem, Mekanisme dan Prosedur',
        'jangka_waktu' => 'Jangka Waktu Pelayanan',
        'biaya' => 'Biaya',
        'produk_pelayanan' => 'Produk Pelayanan',
        'penanganan_pengaduan' => 'Penanganan, Pengaduan, Saran dan Masukan',
        'dasar_hukum' => 'Dasar Hukum',
        'sarana_prasarana' => 'Sarana dan Prasarana dan/atau Fasilitas',
        'kompetensi_pelaksana' => 'Kompetensi Pelaksana',
        'pengawasan_internal' => 'Pengawasan Internal',
        'jumlah_pelaksana' => 'Jumlah Pelaksana',
        'jaminan_pelayanan' => 'Jaminan Pelayanan',
        'jaminan_keamanan' => 'Jaminan Keamanan dan Keselamatan Pelayanan',
        'evaluasi_kinerja' => 'Evaluasi Kinerja Pelaksana',
    ];
@endphp
<div class="sk-page">
    <div class="d-flex justify-content-between align-items-start gap-3 mb-4">
        <div>
            <h1 class="sk-page-title mb-1">Pemeriksaan Draf SK</h1>
            <p class="sk-page-subtitle mb-0">
                {{ $sk->instansi?->nama_instansi }} · SK {{ $sk->no_sk }}
            </p>
        </div>
        <a href="{{ route('admin.sk.index') }}" class="btn btn-light btn-sm rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <section class="sk-main-card mb-4">
        <div class="sk-section-header">
            <div>
                <h2 class="sk-section-title">Informasi SK</h2>
                <p class="sk-section-description">Periksa data dan seluruh komponen layanan sebelum meneruskan.</p>
            </div>
            <a href="{{ route('admin.sk.preview', $sk) }}" target="_blank" class="btn btn-outline-primary">
                <i class="bi bi-file-earmark-pdf me-1"></i> Pratinjau draf
            </a>
        </div>
        <div class="table-responsive px-4 pb-4">
            <table class="table table-bordered align-middle mb-4">
                <tbody>
                    <tr><th style="width:25%">Pemilik SK</th><td>{{ $sk->instansi?->nama_instansi }}</td></tr>
                    <tr><th>Nomor SK</th><td>{{ $sk->no_sk }}</td></tr>
                    <tr><th>Tanggal SK</th><td>{{ $sk->tanggal_sk?->format('d/m/Y') }}</td></tr>
                    <tr><th>Jenis SK</th><td>{{ $sk->jenis_sk }} @if($sk->no_sk_sebelumnya) ({{ $sk->no_sk_sebelumnya }}) @endif</td></tr>
                </tbody>
            </table>

            @forelse ($sk->pelayanan as $layanan)
                <h3 class="h5 text-primary mt-4">{{ $layanan->nama_layanan }}</h3>
                <table class="table table-bordered align-top">
                    <thead class="table-light"><tr><th style="width:35%">Komponen</th><th>Uraian</th></tr></thead>
                    <tbody>
                        @foreach ($fields as $field => $label)
                            <tr>
                                <th>{{ $label }}</th>
                                @php($value = trim(strip_tags($layanan->$field ?? '')))
                                <td>
                                    @if ($value !== '')
                                        {!! nl2br(e($value)) !!}
                                    @else
                                        <span class="text-muted">Belum diisi</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @empty
                <div class="alert alert-warning">SK ini belum memiliki layanan terpilih.</div>
            @endforelse
        </div>
    </section>

    <section class="sk-main-card">
        <div class="sk-section-header">
            <div>
                <h2 class="sk-section-title">Keputusan Pemeriksaan</h2>
                <p class="sk-section-description">Jika ada kekurangan, tuliskan bagian yang perlu diperbaiki oleh pemilik SK.</p>
            </div>
        </div>
        <div class="d-flex flex-wrap justify-content-end gap-2 px-4 pb-4">
            <form method="POST" action="{{ route('admin.sk.return', $sk) }}" class="d-flex flex-column flex-md-row gap-2 w-100">
                @csrf
                @method('PUT')
                <textarea name="review_comment" class="form-control" rows="2" maxlength="5000" required
                          placeholder="Komentar wajib diisi jika SK dikembalikan untuk perbaikan"></textarea>
                <button type="submit" class="btn btn-outline-danger text-nowrap">
                    <i class="bi bi-arrow-return-left me-1"></i> Kembalikan
                </button>
            </form>
            <form method="POST" action="{{ route('admin.sk.forward', $sk) }}">
                @csrf
                @method('PUT')
                <button type="submit" class="btn-primary-custom">
                    <i class="bi bi-send me-1"></i> Sesuai, teruskan ke Instansi
                </button>
            </form>
        </div>
    </section>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/sk.css') }}">
@endpush
