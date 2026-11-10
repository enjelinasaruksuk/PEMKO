@extends('layouts.admin')
@section('title', 'Master Instansi')

@section('content')
<div class="dt-page">

    <div class="dt-page-header">
        <h1 class="dt-page-title">Master Instansi</h1>
        <p class="dt-page-subtitle">Daftar instansi yang tersedia pada form pengajuan akun.</p>
    </div>

    <div class="dt-main-card">

        <div class="dt-section-header">
            <div>
                <h2 class="dt-section-title">Data Instansi</h2>
                <p class="dt-section-description">Kelola instansi Level 1 dan unit layanan Level 2 beserta induknya.</p>
            </div>
            <button type="button" class="dt-add-button" data-bs-toggle="modal" data-bs-target="#modalTambahInstansi">
                <i class="bi bi-plus-circle"></i>
                <span>Tambah</span>
            </button>
        </div>

        <div class="dt-card">

            <div class="dt-table-toolbar">
                <div class="dt-show">
                    <span>{{ $instansiList->count() }} instansi</span>
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
                            <th class="dt-nowrap">Level</th>
                            <th>Induk</th>
                            <th>Email Instansi</th>
                            <th class="dt-nowrap">Akun</th>
                            <th class="dt-nowrap">Status</th>
                            <th class="text-center" style="width:100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="instansiTableBody">
                        @foreach ($instansiList as $instansi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="fw-semibold">{{ $instansi->nama_instansi }}</td>
                                <td class="dt-nowrap">
                                    <span class="dt-badge {{ $instansi->level_instansi == 1 ? 'blue' : 'gray' }}">
                                        Level {{ $instansi->level_instansi }}
                                    </span>
                                </td>
                                <td>{{ $instansi->induk?->nama_instansi ?? '-' }}</td>
                                <td>
                                    @if ($instansi->email_instansi)
                                        {{ $instansi->email_instansi }}
                                    @else
                                        <span class="text-muted">Belum diisi</span>
                                    @endif
                                </td>
                                <td class="dt-nowrap">{{ $instansi->pengguna_count }}</td>
                                <td>
                                    <span class="dt-badge {{ $instansi->status === 'aktif' ? 'green' : 'gray' }}">
                                        {{ ucfirst($instansi->status) }}
                                    </span>
                                </td>
                                <td>
                                    <x-admin.instansi.aksi_instansi :instansi="$instansi" />
                                </td>
                            </tr>
                            <x-admin.instansi.modal_edit_instansi :instansi="$instansi" :instansi-level1="$instansiLevel1" />
                            <x-admin.instansi.modal_hapus_instansi :instansi="$instansi" />
                        @endforeach

                        <tr id="instansiEmptyRow" class="{{ $instansiList->isEmpty() ? '' : 'd-none' }}">
                            <td colspan="8">
                                <div class="dt-empty">
                                    <i class="bi bi-inbox"></i>
                                    <div>Belum ada data instansi.</div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<x-admin.instansi.modal_tambah_instansi :instansi-level1="$instansiLevel1" />
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/data-table.css') }}">
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Pencarian
        const searchInput = document.getElementById('instansiSearch');
        const rows = Array.from(document.querySelectorAll('#instansiTableBody tr')).filter(r => r.id !== 'instansiEmptyRow');
        const emptyRow = document.getElementById('instansiEmptyRow');

        searchInput.addEventListener('input', function () {
            const keyword = this.value.toLowerCase().trim();
            let shown = 0;
            rows.forEach(function (row) {
                const match = !keyword || row.textContent.toLowerCase().includes(keyword);
                row.style.display = match ? '' : 'none';
                if (match) shown++;
            });
            emptyRow.classList.toggle('d-none', shown > 0);
        });

        // Dropdown induk hanya tampil untuk Level 2 (berlaku untuk modal tambah & edit)
        function toggleInduk(select) {
        const form = select.closest('form');
        const wrapper = form.querySelector('.js-induk-wrapper');
        const induk = form.querySelector('.js-induk-select');
        const label = form.querySelector('.js-nama-label');
        const input = form.querySelector('.js-nama-input');
        const isLevel2 = select.value === '2';

        wrapper.classList.toggle('d-none', !isLevel2);
        induk.required = isLevel2;
        if (!isLevel2) induk.value = '';

        // Label dan placeholder nama menyesuaikan level (hanya ada di modal tambah)
        if (label) label.textContent = isLevel2 ? 'Nama Unit Layanan' : 'Nama Instansi';
        if (input) input.placeholder = isLevel2 ? 'Contoh: Bagian Hukum' : 'Contoh: Dinas Pendidikan';
    }

        document.querySelectorAll('.js-level-select').forEach(function (select) {
            toggleInduk(select);
            select.addEventListener('change', () => toggleInduk(select));
        });
    });
</script>
@endpush