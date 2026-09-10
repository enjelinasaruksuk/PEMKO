@extends('layouts.instansi')
@section('title', 'Nama Unit Layanan')

@section('content')
<div class="dt-page">
    <div class="dt-page-header">
        <p class="page-description mb-1">Nama Unit Layanan</p>
        <h1 class="dt-page-title" style="font-size:22px;">Nama Unit Pelayanan</h1>
        <p class="dt-page-subtitle">Berikut Data Nama Unit Pelayanan yang terdaftar.</p>
    </div>

    <div class="dt-card" style="margin:0;">
        <div class="dt-table-toolbar">
            <div class="d-flex gap-2">
                <select class="dt-select" style="width:150px;"><option>Unit Layanan</option></select>
                <select class="dt-select" style="width:150px;"><option>Akun Aktif</option></select>
            </div>
            <div class="dt-search">
                <i class="bi bi-search"></i>
                <input type="text" id="unitLayananSearch" placeholder="Cari...">
            </div>
        </div>

        <div class="dt-table-wrapper">
            <table class="dt-table">
                <thead>
                    <tr>
                        <th style="width:50px">No</th>
                        <th>Unit Layanan</th>
                        <th>Username</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="unitLayananTableBody">
                    @forelse ($unitLayananList ?? [] as $i => $unit)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="text-primary">{{ $unit->nama }}</td>
                            <td>{{ $unit->username }}</td>
                            <td class="text-success">{{ $unit->status }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="dt-empty">Belum ada data unit layanan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="dt-pagination">
            <button type="button"><i class="bi bi-chevron-double-left"></i></button>
            <button type="button"><i class="bi bi-chevron-left"></i></button>
            <button type="button" class="active">1</button>
            <button type="button"><i class="bi bi-chevron-right"></i></button>
            <button type="button"><i class="bi bi-chevron-double-right"></i></button>
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
        const searchInput = document.getElementById('unitLayananSearch');
        const tableBody = document.getElementById('unitLayananTableBody');

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