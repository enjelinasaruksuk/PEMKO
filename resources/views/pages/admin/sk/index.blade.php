@extends('layouts.admin')
@section('title', 'SK')

@section('content')
<div class="sk-page">

    <div class="sk-page-header">
        <h1 class="sk-page-title">SK</h1>
        <p class="sk-page-subtitle">Daftar Surat Keputusan dari seluruh dinas.</p>
    </div>

    <div class="sk-main-card">

        <div class="sk-section-header">
            <div>
                <h2 class="sk-section-title">Data SK</h2>
                <p class="sk-section-description">Kelola dan konfirmasi pengajuan SK dari setiap dinas.</p>
            </div>
        </div>

        <div class="sk-card">

            <div class="sk-table-toolbar">
                <div class="sk-show">
                    <span>Show</span>
                    <select id="skPerPage" class="sk-select">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <span>entries</span>
                </div>

                <div class="sk-search">
                    <i class="bi bi-search"></i>
                    <input type="text" id="skSearch" placeholder="Search:" autocomplete="off">
                </div>
            </div>

            <div class="sk-table-wrapper">
                <table class="sk-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Dinas</th>
                            <th>No SK</th>
                            <th>Tanggal SK</th>
                            <th>Status</th>
                            <th class="text-center">Pengajuan SK <span>(Kepala PD)</span></th>
                            <th class="text-center">Konfirmasi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="skTableBody">
                        @forelse ($skList ?? [] as $i => $sk)
                            <tr>
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td>{{ $sk->nama_dinas }}</td>
                                <td>
                                    <div class="sk-number">{{ $sk->no_sk }}</div>
                                </td>
                                <td>{{ $sk->tanggal_sk }}</td>

                                {{-- STATUS: read-only, tanpa tombol edit --}}
                                <td>
                                    @if ($sk->status === 'Aktif')
                                        <span class="status-active"><i class="bi bi-check-circle"></i> Aktif</span>
                                    @else
                                        <span class="status-inactive"><i class="bi bi-x-circle"></i> Tidak Aktif</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    @if ($sk->sudah_diajukan)
                                        <span class="approval approved"><i class="bi bi-check-circle"></i> Sudah diajukan</span>
                                    @else
                                        <span class="approval pending"><i class="bi bi-clock"></i> Belum diajukan</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <div class="sk-confirmation">
                                        @if ($sk->konfirmasi_status === 'disetujui')
                                            <button type="button" class="sk-icon-btn success" data-bs-toggle="modal"
                                                    data-bs-target="#modalKonfirmasiSk{{ $sk->id }}" title="Sudah disetujui">
                                                <i class="bi bi-check-circle"></i>
                                            </button>
                                        @else
                                            <button type="button" class="sk-icon-btn clock" data-bs-toggle="modal"
                                                    data-bs-target="#modalKonfirmasiSk{{ $sk->id }}" title="Belum disetujui">
                                                <i class="bi bi-clock"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>

                                <td class="text-center">
                                    <x-admin.sk.aksi_sk :sk="$sk" />
                                </td>
                            </tr>
                            <x-admin.sk.modal_konfirmasi_sk :sk="$sk" />
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">
                                    <div class="sk-empty">
                                        <i class="bi bi-inbox"></i>
                                        <div>Belum ada data SK.</div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="sk-pagination">
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
    <link rel="stylesheet" href="{{ asset('css/sk.css') }}">
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('skSearch');
        const tableBody = document.getElementById('skTableBody');

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