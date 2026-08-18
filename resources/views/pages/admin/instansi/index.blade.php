@extends('layouts.admin')
@section('title', 'Master Instansi')

@section('content')
    <x-breadcrumb :items="['Dashboard']" title="Master" />

    <x-admin.instansi.filter_bar modal-target="#modalTambahInstansi" />

    <div class="bg-white rounded shadow-sm p-3">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <small class="text-muted">Showing {{ count($instansiList ?? []) }} of 10 projects</small>
            <div class="dropdown">
                <button class="btn btn-sm btn-light border dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Filter
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Terbaru</a></li>
                    <li><a class="dropdown-item" href="#">Nama A-Z</a></li>
                </ul>
            </div>
        </div>

        <table class="table align-middle">
            <thead>
                <tr class="bg-light">
                    <th style="width:50px">No</th>
                    <th>Nama Instansi</th>
                    <th style="width:160px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($instansiList ?? [] as $i => $instansi)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="text-primary">{{ $instansi->nama }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditInstansi{{ $instansi->id }}">Edit</button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapusInstansi{{ $instansi->id }}">Hapus</button>
                            </div>
                        </td>
                    </tr>
                    <x-admin.instansi.modal_edit_instansi :instansi="$instansi" />
                    <x-admin.instansi.modal_hapus_instansi :instansi="$instansi" />
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-3">Belum ada data instansi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <x-admin.instansi.modal_tambah_instansi :instansi-level1="$instansiLevel1 ?? []" :instansi-level2="$instansiLevel2 ?? []" />
@endsection

@push('scripts')
<script>
    document.getElementById('levelAkun').addEventListener('change', function () {
        const wrapperLevel2 = document.getElementById('wrapperLevel2');
        if (this.value === '2') {
            wrapperLevel2.classList.remove('d-none');
        } else {
            wrapperLevel2.classList.add('d-none');
        }
    });
</script>
@endpush