@extends('layouts.admin')
@section('title', 'Akun Pengguna')

@section('content')
<div class="dt-page">

    <div class="dt-page-header">
        <h1 class="dt-page-title">Akun Pengguna</h1>
        <p class="dt-page-subtitle">Daftar akun pengguna yang terdaftar pada masing-masing instansi.</p>
    </div>

    <div class="dt-main-card">

        <div class="dt-section-header">
            <div>
                <h2 class="dt-section-title">Data Pengguna</h2>
                <p class="dt-section-description">Kelola akun pengguna di seluruh instansi.</p>
            </div>
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
                    <input type="text" id="penggunaSearch" placeholder="Cari pengguna..." autocomplete="off">
                </div>
            </div>

            <div class="dt-table-wrapper">
                <table class="dt-table">
                    <thead>
                        <tr>
                            <th style="width:50px">No.</th>
                            <th>Nama</th>
                            <th>Instansi</th>
                            <th>Peran</th>
                            <th>Status</th>
                            <th>Masuk Terakhir</th>
                            <th class="text-center"> Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="penggunaTableBody">
                        @forelse ($penggunaList ?? [] as $i => $item)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="dt-avatar">{{ strtoupper(substr($item->nama, 0, 1)) }}</span>
                                        <div>
                                            <div class="fw-semibold">{{ $item->nama }}</div>
                                            <div class="text-muted small">{{ $item->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>{{ $item->instansi_nama }}</div>
                                    <div class="text-muted small">{{ $item->instansi_singkatan }}</div>
                                </td>
                                <td><span class="dt-badge blue">{{ $item->peran }}</span></td>
                                <td><span class="dt-badge green">{{ $item->status }}</span></td>
                                <td>{{ $item->masuk_terakhir }}</td>
                                <td>
                                    <x-admin.pengguna.aksi_pengguna :pengguna="$item" />
                                </td>
                            </tr>
                            <x-admin.pengguna.modal_hapus_pengguna :pengguna="$item" />
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="dt-empty">
                                        <i class="bi bi-inbox"></i>
                                        <div>Belum ada data pengguna.</div>
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
        const searchInput = document.getElementById('penggunaSearch');
        const tableBody = document.getElementById('penggunaTableBody');

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