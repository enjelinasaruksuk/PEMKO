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
                @if ($maklumatList->isNotEmpty())
                <a href="{{ route('pdf.maklumat', $maklumatList->first()) }}" target="_blank" class="btn-primary-custom text-decoration-none">
                    <i class="bi bi-printer me-1"></i> Cetak Maklumat
                </a>
                @endif
                <button type="button" class="btn-primary-custom" data-bs-toggle="modal" data-bs-target="#modalTambahMaklumat">
                    Tambah Maklumat / Ganti TTD
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered align-middle" id="maklumatTable">
                <thead>
                    <tr>
                        <th style="width:40px">No.</th>
                        <th>Instansi</th>
                        <th>Maklumat</th>
                        <th style="width:150px">Nama Penjabat</th>
                        <th style="width:150px">NIP</th>
                        <th style="width:150px">Tanggal Input Maklumat</th>
                        <th style="width:90px" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($maklumatList as $i => $m)
                    <tr>
                        <td class="text-center">{{ $i + 1 }}</td>
                        <td>{{ optional($m->instansi)->nama_instansi ?? '-' }}</td>
                        <td>{{ $m->isi_maklumat }}</td>
                        <td>{{ $m->nama_penjabat ?? '-' }}</td>
                        <td>{{ $m->nip_penjabat ?? '-' }}</td>
                        <td>{{ $m->tanggal_input ? $m->tanggal_input->translatedFormat('d F Y') : '-' }}</td>
                        <td>
                            <a href="{{ route('pdf.maklumat', $m) }}" target="_blank"
                               class="sk-icon-btn pdf" title="Cetak Maklumat PDF">
                                <i class="bi bi-file-earmark-pdf"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Belum ada data maklumat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<x-instansi.maklumat.modal-tambah />
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('maklumatSearch');
        const table = document.getElementById('maklumatTable');

        if (searchInput && table) {
            searchInput.addEventListener('input', function() {
                const keyword = this.value.toLowerCase().trim();
                table.querySelectorAll('tbody tr').forEach(function(row) {
                    const text = row.textContent.toLowerCase();
                    row.style.display = (!keyword || text.includes(keyword)) ? '' : 'none';
                });
            });
        }
    });
</script>
@endpush