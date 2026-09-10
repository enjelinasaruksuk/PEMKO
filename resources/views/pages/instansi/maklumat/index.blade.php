@extends('layouts.instansi')
@section('title', 'Maklumat')

@section('content')
<div>
    <p class="page-description mb-1">Dashboard / Maklumat</p>
    <h1 class="page-title mb-3">Maklumat</h1>

    <div class="card-custom p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="input-group input-group-sm" style="max-width:220px;">
                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control" id="maklumatSearch" placeholder="Search">
            </div>
            <div class="d-flex gap-2">
                <button type="button" class="btn-primary-custom" onclick="window.print()">Cetak Maklumat</button>
                <button type="button" class="btn-primary-custom" data-bs-toggle="modal" data-bs-target="#modalTambahMaklumat">
                    Tambah Maklumat
                </button>
            </div>
        </div>

        <table class="table table-bordered align-middle" style="font-size:12px;" id="maklumatTable">
            <thead>
                <tr>
                    <th style="width:40px">No.</th>
                    <th>Pengajuan Maklumat</th>
                    <th style="width:150px">Nama Penjebat</th>
                    <th style="width:150px">Tanggal Input Maklumat</th>
                    <th style="width:120px">Approved</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($maklumatList as $i => $m)
                    <tr>
                        <td class="text-center">{{ $i + 1 }}</td>
                        <td>{{ $m->isi }}</td>
                        <td>{{ $m->nama_penjebat }}</td>
                        <td>{{ \Carbon\Carbon::parse($m->tanggal_input)->translatedFormat('d F Y') }}</td>
                        <td>
                            @if ($m->status === 'disetujui')
                                <span class="text-success">Sudah disetujui</span>
                            @else
                                <span class="text-warning">Pending <i class="bi bi-send"></i></span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted py-3">Belum ada data maklumat.</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center gap-2 mt-2">
            <button class="btn btn-sm btn-light">«</button>
            <button class="btn btn-sm btn-primary">1</button>
            <button class="btn btn-sm btn-light">»</button>
        </div>
    </div>
</div>

<x-instansi.maklumat.modal-tambah />
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('maklumatSearch');
    const table = document.getElementById('maklumatTable');

    if (searchInput && table) {
        searchInput.addEventListener('input', function () {
            const keyword = this.value.toLowerCase().trim();
            table.querySelectorAll('tbody tr').forEach(function (row) {
                const text = row.textContent.toLowerCase();
                row.style.display = (!keyword || text.includes(keyword)) ? '' : 'none';
            });
        });
    }
});
</script>
@endpush