@extends('layouts.unit-layanan')

@section('title', 'Maklumat')

@section('content')

<div class="maklumat-page">

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="d-flex justify-content-between align-items-start maklumat-page-header">
        <div>
            <h1 class="maklumat-page-title">
                Informasi Data Maklumat
            </h1>

            <p class="maklumat-page-subtitle">
                Informasi data Maklumat yang terdapat dalam masing-masing dinas.
            </p>
        </div>

        <button type="button" class="btn-primary-custom" data-bs-toggle="modal" data-bs-target="#modalGantiPejabat">
            <i class="bi bi-person-badge me-1"></i>
            Ganti Pejabat
        </button>
    </div>

    {{-- =====================================================
         TABLE
    ====================================================== --}}

    <x-unit-layanan.maklumat.table :maklumat-list="$maklumatList" />

</div>

{{-- =========================================================
     MODAL GANTI PEJABAT
========================================================= --}}

<div class="modal fade" id="modalGantiPejabat" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h5 class="fw-bold mb-1">Ganti Pejabat</h5>
                        <p class="text-muted small mb-0">
                            Nama pejabat yang diisi akan menjadi penandatangan (ttd) Maklumat terbaru,
                            dan otomatis tampil di halaman Profil. Nama pejabat bersifat opsional —
                            bisa dikosongkan dulu jika belum ditentukan.
                        </p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="{{ route('unit_layanan.maklumat.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label-custom">Nama Pejabat Baru (opsional)</label>
                        <input type="text" name="nama_penjabat_baru" class="form-control"
                               placeholder="Masukkan Nama Pejabat">
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-primary-custom">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection


{{-- =========================================================
     STYLE
========================================================= --}}

@push('styles')

    @include('pages.unit-layanan.maklumat._styles')

@endpush


{{-- =========================================================
     SCRIPT
========================================================= --}}

@push('scripts')

    @include('pages.unit-layanan.maklumat._scripts')

@endpush