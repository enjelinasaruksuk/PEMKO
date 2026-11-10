@extends('layouts.admin')
@section('title', 'Maklumat')

@section('content')
<div class="dt-page">

    <div class="dt-page-header">
        <h1 class="dt-page-title">Maklumat</h1>
        <p class="dt-page-subtitle">Daftar maklumat pelayanan yang diajukan oleh instansi.</p>
    </div>

    <div class="dt-main-card">

        <div class="dt-section-header">
            <div>
                <h2 class="dt-section-title">Data Maklumat</h2>
                <p class="dt-section-description">Konfirmasi persetujuan maklumat pelayanan.</p>
            </div>
        </div>

        <div class="dt-card">

            <div class="dt-table-toolbar">
                <div class="dt-show">
                    <span>{{ ($maklumatList ?? collect())->count() }} maklumat</span>
                </div>

                <div class="dt-search">
                    <i class="bi bi-search"></i>
                    <input type="text" id="maklumatSearch" placeholder="Cari maklumat..." autocomplete="off">
                </div>
            </div>

            <div class="dt-table-wrapper">
                <table class="dt-table">
                    <thead>
                        <tr>
                            <th style="width:50px">No</th>
                            <th>Instansi</th>
                            <th>Maklumat</th>
                            <th class="dt-nowrap">Nama Penjabat</th>
                            <th class="dt-nowrap">Tanggal Input</th>
                            <th class="dt-nowrap">Status</th>
                            <th class="text-center" style="width:90px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="maklumatTableBody">
                        @forelse ($maklumatList ?? [] as $i => $maklumat)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td class="fw-semibold">{{ $maklumat->instansi?->nama_instansi ?? '-' }}</td>
                                <td class="dt-cell-wrap">{{ $maklumat->isi_maklumat }}</td>
                                <td class="dt-nowrap">
                                    <div>{{ $maklumat->nama_penjabat ?? '-' }}</div>
                                    <div class="text-muted small">NIP {{ $maklumat->nip_penjabat ?? '-' }}</div>
                                </td>
                                <td class="dt-nowrap">{{ $maklumat->tanggal_input?->translatedFormat('d F Y') ?? '-' }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        @if ($maklumat->status === 'disetujui')
                                            <span class="dt-badge green">Disetujui</span>
                                        @elseif ($maklumat->status === 'ditolak')
                                            <span class="dt-badge gray">Ditolak</span>
                                        @else
                                            <span class="dt-badge blue">Pending</span>
                                            <button type="button" class="dt-icon-btn edit" data-bs-toggle="modal"
                                                    data-bs-target="#modalKonfirmasi{{ $maklumat->id }}" title="Konfirmasi Maklumat">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="dt-actions justify-content-center">
                                        @if ($maklumat->status === 'disetujui')
                                            <a href="{{ route('pdf.maklumat', $maklumat) }}" target="_blank"
                                               class="dt-icon-btn pdf" title="Cetak Maklumat PDF">
                                                <i class="bi bi-file-earmark-pdf"></i>
                                            </a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @if ($maklumat->status === 'pending')
                                <x-admin.maklumat.modal_konfirmasi_maklumat :maklumat="$maklumat" />
                            @endif
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="dt-empty">
                                        <i class="bi bi-inbox"></i>
                                        <div>Belum ada data maklumat.</div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/data-table.css') }}">
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('maklumatSearch');
        const tableBody = document.getElementById('maklumatTableBody');

        if (searchInput && tableBody) {
            searchInput.addEventListener('input', function () {
                const keyword = this.value.toLowerCase().trim();
                tableBody.querySelectorAll('tr').forEach(function (row) {
                    row.style.display = (!keyword || row.textContent.toLowerCase().includes(keyword)) ? '' : 'none';
                });
            });
        }
    });
</script>
@endpush