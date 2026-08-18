@extends('layouts.admin')
@section('title', 'Akun Pengguna')

@section('content')
    <x-breadcrumb :items="['Dashboard', 'Manajemen Akun']" title="Akun Pengguna" />

    <div class="bg-white rounded shadow-sm p-3">
        <table class="table align-middle">
            <thead>
                <tr class="bg-light">
                    <th style="width:50px">No.</th>
                    <th>Nama</th>
                    <th>Instansi</th>
                    <th>Peran</th>
                    <th>Status</th>
                    <th>Masuk Terakhir</th>
                    <th style="width:140px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($penggunaList ?? [] as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>
                            <div class="fw-semibold">{{ $item->nama }}</div>
                            <small class="text-muted fst-italic">{{ $item->email }}</small>
                        </td>
                        <td>
                            {{ $item->instansi_nama }}<br>
                            <small class="text-muted">{{ $item->instansi_singkatan }}</small>
                        </td>
                        <td>{{ $item->peran }}</td>
                        <td class="text-success">{{ $item->status }}</td>
                        <td>{{ $item->masuk_terakhir }}</td>
                        <td>
                            <x-admin.pengguna.aksi_pengguna :pengguna="$item" />
                        </td>
                    </tr>
                    <x-admin.pengguna.modal_hapus_pengguna :pengguna="$item" />
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-3">Belum ada data pengguna.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection