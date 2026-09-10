@extends('layouts.instansi')
@section('title', 'Pengesahan SK - ' . $namaUnit)

@section('content')
<div class="sk-page">
    <div class="mb-3">
        <h1 class="page-title mb-1" style="font-size:20px;">Informasi Data SK Unit Layanan</h1>
        <p class="page-description mb-0">Informasi Data SK Unit Layanan yang tercatat.</p>
    </div>

    <div class="sk-card">
        <div class="sk-table-toolbar">
            <div class="sk-show">
                <span>Show</span>
                <select class="sk-select"><option>10</option></select>
                <span>entries</span>
            </div>
            <div class="sk-search">
                <i class="bi bi-search"></i>
                <input type="text" id="skUnitSearch" placeholder="Search:">
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
                        <th class="text-center">Pengesahan SK <span>(Kepala PD)</span></th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody id="skUnitTableBody">
                    @forelse ($skList as $i => $sk)
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td>{{ $sk->nama_dinas }}</td>
                            <td><div class="sk-number">{{ $sk->no_sk }}</div></td>
                            <td>{{ \Carbon\Carbon::parse($sk->tanggal_sk)->format('d/m/Y') }}</td>
                            <td>
                                <span class="{{ $sk->status === 'Aktif' ? 'status-active' : 'status-inactive' }}">
                                    <i class="bi bi-{{ $sk->status === 'Aktif' ? 'check' : 'x' }}-circle"></i> {{ $sk->status }}
                                </span>
                            </td>
                            <td class="text-center">
                                @if ($sk->pengesahan === 'Sudah disetujui')
                                    <span class="approval approved"><i class="bi bi-check-circle"></i> Sudah disetujui</span>
                                @else
                                    <span class="approval pending"><i class="bi bi-clock"></i> Belum disetujui</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button type="button" class="sk-icon-btn view" data-bs-toggle="modal"
                                        data-bs-target="#modalApprovalSk{{ $sk->id }}" title="Approval SK">
                                    <i class="bi bi-journal-check"></i>
                                </button>
                            </td>
                        </tr>
                        <x-instansi.sk.modal-approval :sk="$sk" :unit="$unit" />
                    @empty
                        <tr><td colspan="7" class="text-center"><div class="sk-empty"><i class="bi bi-inbox"></i><div>Belum ada data SK.</div></div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="sk-pagination">
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
    @include('pages.unit-layanan.sk._styles')
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('skUnitSearch');
    const tableBody = document.getElementById('skUnitTableBody');

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