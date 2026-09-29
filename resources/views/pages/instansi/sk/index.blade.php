@extends('layouts.instansi')
@section('title', 'Pelayanan SK')

@section('content')
<div class="sk-page">

    <div class="sk-page-header">
        <h1 class="sk-page-title">Pelayanan SK</h1>
        <p class="sk-page-subtitle">Pilih unit layanan untuk melihat dan mengesahkan SK.</p>
    </div>

    <div class="sk-main-card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead><tr><th>No</th><th>Nama Unit Layanan</th><th>Pengguna</th><th>Status</th><th>Aksi</th></tr></thead>
                <tbody>
                    @forelse ($unitLayananList as $unit)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $unit->nama_instansi }}</td>
                        <td>{{ $unit->pengguna_count }}</td>
                        <td>{{ ucfirst($unit->status) }}</td>
                        <td>
                            <a href="{{ route('instansi.pelayanan_sk.show', $unit) }}"
                               class="sk-icon-btn view" title="Lihat SK {{ $unit->nama_instansi }}">
                                <i class="bi bi-clipboard"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">Belum ada unit layanan terdaftar.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection