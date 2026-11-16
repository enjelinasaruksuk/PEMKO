@extends('layouts.admin')
@section('title', 'Tanda Tangan')

@section('content')
<div class="dt-page">

    <div class="dt-page-header">
        <h1 class="dt-page-title">Tanda Tangan</h1>
        <p class="dt-page-subtitle">Spesimen tanda tangan pejabat yang dipakai pada SK dan Maklumat.</p>
    </div>

    <div class="dt-main-card">

        <div class="dt-section-header">
            <div>
                <h2 class="dt-section-title">Data Spesimen</h2>
                <p class="dt-section-description">NIP harus sama dengan NIP pada profil instansi yang menandatangani.</p>
            </div>
            <button type="button" class="dt-add-button" data-bs-toggle="modal" data-bs-target="#modalTambahTtd">
                <i class="bi bi-plus-circle"></i>
                <span>Tambah</span>
            </button>
        </div>

        <div class="dt-card">

            <div class="dt-table-toolbar">
                <div class="dt-show">
                    <span>{{ $ttdList->count() }} spesimen</span>
                </div>

                <div class="dt-search">
                    <i class="bi bi-search"></i>
                    <input type="text" id="ttdSearch" placeholder="Cari NIP atau nama..." autocomplete="off">
                </div>
            </div>

            <div class="dt-table-wrapper">
                <table class="dt-table">
                    <thead>
                        <tr>
                            <th style="width:50px">No</th>
                            <th class="dt-nowrap">NIP</th>
                            <th>Pejabat (dari profil)</th>
                            <th class="text-center">Preview</th>
                            <th class="dt-nowrap">Status File</th>
                            <th class="dt-nowrap">Diperbarui</th>
                            <th class="text-center" style="width:90px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="ttdTableBody">
                        @foreach ($ttdList as $i => $ttd)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td class="dt-nowrap fw-semibold">{{ $ttd->nip }}</td>
                                <td>
                                    @if ($ttd->nama)
                                        <div>{{ $ttd->nama }}</div>
                                        <div class="text-muted small">{{ $ttd->instansi ?? '-' }}</div>
                                    @else
                                        <span class="dt-badge gray">Belum terhubung ke profil</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($ttd->file_ada)
                                        <img src="{{ route('admin.tanda_tangan.show', $ttd->model) }}?v={{ $ttd->diperbarui?->timestamp }}"
                                             alt="TTD {{ $ttd->nip }}"
                                             style="height:44px; max-width:120px; object-fit:contain; background:#fff; border:1px solid #e5e9ee; border-radius:6px; padding:2px;">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($ttd->file_ada)
                                        <span class="dt-badge green">Tersedia</span>
                                    @else
                                        <span class="dt-badge gray">File hilang</span>
                                    @endif
                                </td>
                                <td class="dt-nowrap">{{ $ttd->diperbarui?->translatedFormat('d F Y H:i') ?? '-' }}</td>
                                <td>
                                    <div class="dt-actions justify-content-center">
                                        <button type="button" class="dt-icon-btn edit" data-bs-toggle="modal"
                                                data-bs-target="#modalTambahTtd" data-nip="{{ $ttd->nip }}" title="Ganti file">
                                            <i class="bi bi-arrow-repeat"></i>
                                        </button>
                                        <button type="button" class="dt-icon-btn delete" data-bs-toggle="modal"
                                                data-bs-target="#modalHapusTtd{{ $ttd->nip }}" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <x-admin.tanda_tangan.modal_hapus :ttd="$ttd" />
                        @endforeach

                        @if ($ttdList->isEmpty())
                            <tr>
                                <td colspan="7">
                                    <div class="dt-empty">
                                        <i class="bi bi-inbox"></i>
                                        <div>Belum ada spesimen tanda tangan.</div>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<x-admin.tanda_tangan.modal_tambah />
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/data-table.css') }}">
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('ttdSearch');
        const tableBody = document.getElementById('ttdTableBody');

        if (searchInput && tableBody) {
            searchInput.addEventListener('input', function () {
                const keyword = this.value.toLowerCase().trim();
                tableBody.querySelectorAll('tr').forEach(function (row) {
                    row.style.display = (!keyword || row.textContent.toLowerCase().includes(keyword)) ? '' : 'none';
                });
            });
        }
                // ===== Validasi NIP langsung (harus 18 digit angka) =====
        const nipField = document.getElementById('ttdNip');
        if (nipField) {
            const nipForm = nipField.closest('form');
            const nipSubmit = nipForm ? nipForm.querySelector('[type="submit"]') : null;

            nipField.setAttribute('inputmode', 'numeric');
            nipField.maxLength = 18;

            const nipHint = document.createElement('div');
            nipHint.className = 'small mt-1';
            nipField.insertAdjacentElement('afterend', nipHint);

            function cekNip() {
                const bersih = nipField.value.replace(/\D/g, '');
                if (nipField.value !== bersih) nipField.value = bersih;

                const jumlah = bersih.length;

                if (jumlah === 0) {
                    nipHint.style.color = '#6c7a8f';
                    nipHint.textContent = 'NIP harus 18 digit angka.';
                } else if (jumlah < 18) {
                    nipHint.style.color = '#dc3545';
                    nipHint.textContent = 'Kurang ' + (18 - jumlah) + ' digit lagi (' + jumlah + '/18).';
                } else {
                    nipHint.style.color = '#198754';
                    nipHint.textContent = 'NIP lengkap (18/18).';
                }

                if (nipSubmit) nipSubmit.disabled = jumlah !== 18;
            }

            nipField.addEventListener('input', cekNip);
            // Modal mengisi/mengosongkan NIP saat dibuka, jadi cek ulang setelah tampil
            document.getElementById('modalTambahTtd')?.addEventListener('shown.bs.modal', cekNip);
            cekNip();
        }

        // Tombol "Ganti file" mengisi NIP otomatis; tombol "Tambah" mengosongkannya.
       const prefillNip = @json(preg_replace('/\D/', '', (string) request('nip')));

        const modalTambah = document.getElementById('modalTambahTtd');
        if (modalTambah) {
            modalTambah.addEventListener('show.bs.modal', function (event) {
                const nipInput = document.getElementById('ttdNip');
                const nip = event.relatedTarget
                    ? (event.relatedTarget.getAttribute('data-nip') || '')
                    : prefillNip;
                nipInput.value = nip;
                nipInput.readOnly = nip !== '';
                document.getElementById('ttdFile').value = '';
            });

            if (prefillNip) {
                new bootstrap.Modal(modalTambah).show();
            }
        }
    });
</script>
@endpush