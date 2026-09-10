@extends('layouts.admin')
@section('title', 'Pengajuan Akun Instansi')

@section('content')
<div class="dt-page">

    <div class="dt-page-header">
        <h1 class="dt-page-title">Pengajuan Akun Instansi</h1>
        <p class="dt-page-subtitle">Daftar pengajuan pembuatan akun dari instansi.</p>
    </div>

    <div class="dt-main-card">

        <div class="dt-section-header">
            <div>
                <h2 class="dt-section-title">Data Pengajuan</h2>
                <p class="dt-section-description">Setujui atau tolak pengajuan akun instansi.</p>
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
                    <input type="text" id="pengajuanSearch" placeholder="Cari pengajuan..." autocomplete="off">
                </div>
            </div>

            <div class="dt-table-wrapper">
                <table class="dt-table">
                    <thead>
                        <tr>
                            <th style="width:50px">No</th>
                            <th>Instansi Level 1</th>
                            <th>Instansi Level 2</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="pengajuanTableBody">
                        @forelse ($pengajuanList ?? [] as $i => $pengajuan)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td class="fw-semibold">{{ $pengajuan->instansi_level_1 }}</td>
                                <td>{{ $pengajuan->instansi_level_2 ?? '-' }}</td>
                                <td>{{ $pengajuan->email }}</td>
                                <td>
                                    @if ($pengajuan->status === 'pending')
                                        <span class="dt-badge blue">Pending</span>
                                    @elseif ($pengajuan->status === 'disetujui')
                                        <span class="dt-badge green">Disetujui</span>
                                    @else
                                        <span class="dt-badge gray">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    <x-admin.instansi_pengajuan.aksi_pengajuan :pengajuan="$pengajuan" />
                                </td>
                            </tr>
                            <x-admin.instansi_pengajuan.modal_pengajuan_akun :pengajuan="$pengajuan" />
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="dt-empty">
                                        <i class="bi bi-inbox"></i>
                                        <div>Belum ada pengajuan akun.</div>
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
        const searchInput = document.getElementById('pengajuanSearch');
        const tableBody = document.getElementById('pengajuanTableBody');

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