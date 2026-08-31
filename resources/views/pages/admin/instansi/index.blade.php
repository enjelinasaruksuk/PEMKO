@extends('layouts.admin')
@section('title', 'Master Instansi')

@section('content')
<div class="dt-page">

    <div class="dt-page-header">
        <h1 class="dt-page-title">Master Instansi</h1>
        <p class="dt-page-subtitle">Daftar instansi yang terdaftar dalam sistem.</p>
    </div>

    <div class="dt-main-card">

        <div class="dt-section-header">
            <div>
                <h2 class="dt-section-title">Data Instansi</h2>
                <p class="dt-section-description">Kelola data instansi level 1 dan level 2.</p>
            </div>
            <button type="button" class="dt-add-button" data-bs-toggle="modal" data-bs-target="#modalTambahInstansi">
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
                    <input type="text" id="instansiSearch" placeholder="Cari instansi..." autocomplete="off">
                </div>
            </div>

            <div class="dt-table-wrapper">
                <table class="dt-table">
                    <thead>
                        <tr>
                            <th style="width:50px">No</th>
                            <th>Nama Instansi</th>
                            <th>Level Instansi</th>
                            <th>Email Instansi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="instansiTableBody">
                        @forelse ($instansiList ?? [] as $i => $instansi)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td class="fw-semibold">{{ $instansi->nama }}</td>
                                <td> @if ($instansi->level_akun == 1)  Instansi Level 1
                                    @elseif ($instansi->level_akun == 2) Instansi Level 2
                                    @else
                                    @endif
                                </td>
                                <td>{{ $instansi->email ?? '-' }}</td>
                                <td>
                                    <x-admin.instansi.aksi_instansi :instansi="$instansi" />
                                </td>
                            </tr>
                            <x-admin.instansi.modal_edit_instansi :instansi="$instansi" />
                            <x-admin.instansi.modal_hapus_instansi :instansi="$instansi" />
                        @empty
                            <tr>
                                <td colspan="3">
                                    <div class="dt-empty">
                                        <i class="bi bi-inbox"></i>
                                        <div>Belum ada data instansi.</div>
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

<x-admin.instansi.modal_tambah_instansi :instansi-level1="$instansiLevel1 ?? []" :instansi-level2="$instansiLevel2 ?? []" />
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/data-table.css') }}">
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('levelAkun').addEventListener('change', function () {
            const wrapperLevel2 = document.getElementById('wrapperLevel2');
            wrapperLevel2.classList.toggle('d-none', this.value !== '2');
        });

        const searchInput = document.getElementById('instansiSearch');
        const tableBody = document.getElementById('instansiTableBody');

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