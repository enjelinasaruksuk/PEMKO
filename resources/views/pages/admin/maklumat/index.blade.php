@extends('layouts.admin')
@section('title', 'Maklumat')

@section('content')
<div class="dt-page">

    <div class="dt-page-header">
        <h1 class="dt-page-title">Maklumat</h1>
        <p class="dt-page-subtitle">Daftar maklumat pelayanan yang diajukan oleh unit layanan.</p>
    </div>

    <div class="dt-main-card">

        <div class="dt-section-header">
            <div>
                <h2 class="dt-section-title">Data Maklumat</h2>
                <p class="dt-section-description">Konfirmasi persetujuan maklumat pelayanan.</p>
            </div>
            <button type="button" class="dt-add-button">
                <i class="bi bi-printer"></i>
                <span>Cetak Maklumat</span>
            </button>
        </div>

        <div class="dt-card">

            <div class="dt-table-toolbar">
                <div class="dt-show">
                    <span>Show</span>
                    <select class="dt-select">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <span>entries</span>
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
                            <th>Pengajuan Maklumat</th>
                            <th style="width:170px">Nama Penjebat</th>
                            <th style="width:170px">Tanggal Input Maklumat</th>
                          <th style="width:160px; text-align:center;">Approved</th>
                        </tr>
                    </thead>
                    <tbody id="maklumatTableBody">
                        @forelse ($maklumatList ?? [] as $i => $maklumat)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $maklumat->isi }}</td>
                                <td>{{ $maklumat->nama_penjebat }}</td>
                                <td>{{ $maklumat->tanggal_input }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        @if ($maklumat->status === 'disetujui')
                                            <span class="dt-badge green">Sudah disetujui</span>
                                        @else
                                            <span class="dt-badge blue">Pending</span>
                                            <button type="button" class="dt-icon-btn edit" data-bs-toggle="modal"
                                                    data-bs-target="#modalKonfirmasi{{ $maklumat->id }}" title="Konfirmasi Maklumat">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <x-admin.maklumat.modal_konfirmasi_maklumat :maklumat="$maklumat" />
                        @empty
                            <tr>
                                <td colspan="5">
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

            <div class="dt-pagination">
                <button type="button" title="Halaman pertama"><i class="bi bi-chevron-double-left"></i></button>
                <button type="button" title="Sebelumnya"><i class="bi bi-chevron-left"></i></button>
                <button type="button" class="active">1</button>
                <button type="button" title="Berikutnya"><i class="bi bi-chevron-right"></i></button>
                <button type="button" title="Halaman terakhir"><i class="bi bi-chevron-double-right"></i></button>
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
                    const text = row.textContent.toLowerCase();
                    row.style.display = (!keyword || text.includes(keyword)) ? '' : 'none';
                });
            });
        }
    });
</script>
@endpush