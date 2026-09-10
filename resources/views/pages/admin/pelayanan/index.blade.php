@extends('layouts.admin')
@section('title', 'Komponen Pelayanan')

@section('content')
<div class="dt-page">

    <div class="dt-page-header">
        <h1 class="dt-page-title">Komponen Pelayanan</h1>
        <p class="dt-page-subtitle">Daftar komponen standar pelayanan yang digunakan dalam sistem.</p>
    </div>

    <div class="dt-main-card">

        <div class="dt-section-header">
            <div>
                <h2 class="dt-section-title">Data Komponen</h2>
                <p class="dt-section-description">Kelola komponen pelayanan berdasarkan kategori.</p>
            </div>
            <button type="button" class="dt-add-button" data-bs-toggle="modal" data-bs-target="#modalTambahKomponen">
                <i class="bi bi-plus-circle"></i>
                <span>Tambah</span>
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
                    <input type="text" id="komponenSearch" placeholder="Cari komponen..." autocomplete="off">
                </div>
            </div>

            <div class="dt-table-wrapper">
                <table class="dt-table">
                    <thead>
                        <tr>
                            <th style="width:50px">No</th>
                            <th>Nama Komponen</th>
                            <th>Kategori</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="komponenTableBody">
                        @forelse ($komponenList ?? [] as $i => $komponen)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td class="fw-semibold">{{ $komponen->nama_komponen }}</td>
                                <td>
                                    <span class="dt-badge {{ $komponen->kategori === 'Penyampaian' ? 'blue' : 'gray' }}">
                                        {{ $komponen->kategori }}
                                    </span>
                                </td>
                                <td>
                                    <x-admin.pelayanan.aksi_komponen :komponen="$komponen" />
                                </td>
                            </tr>
                            <x-admin.pelayanan.modal_edit_komponen :komponen="$komponen" />
                            <x-admin.pelayanan.modal_hapus_komponen :komponen="$komponen" />
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="dt-empty">
                                        <i class="bi bi-inbox"></i>
                                        <div>Belum ada data komponen.</div>
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

<x-admin.pelayanan.modal_tambah_komponen />
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/data-table.css') }}">
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('komponenSearch');
        const tableBody = document.getElementById('komponenTableBody');

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