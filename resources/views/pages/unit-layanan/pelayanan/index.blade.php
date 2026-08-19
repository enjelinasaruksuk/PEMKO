
@extends('layouts.unit-layanan')

@section('title', 'Informasi Layanan')

@section('content')

<div class="d-flex justify-content-between align-items-start mb-3">

    <div>

        <h1 class="page-title mb-1">
            Informasi Layanan
        </h1>

        <p class="page-description mb-0">
            Informasi layanan yang tercatat pada Bagian Organisasi
        </p>

    </div>

    <a
        href="{{ route('unit_layanan.pelayanan.create') }}"
        class="btn-primary-custom text-decoration-none"
    >
        <i class="bi bi-plus-circle me-1"></i>
        Tambah Data
    </a>

</div>


<div class="card-custom p-3">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <div class="small">

            Show

            <select
                class="form-select form-select-sm d-inline-block"
                style="width:60px;"
            >
                <option>10</option>
                <option>25</option>
                <option>50</option>
            </select>

            entries

        </div>


        <div>

            <div class="input-group input-group-sm">

                <span class="input-group-text bg-white">
                    <i class="bi bi-search"></i>
                </span>

                <input
                    type="text"
                    class="form-control"
                    placeholder="Search"
                >

            </div>

        </div>

    </div>


    <div class="table-responsive">

        <table class="table table-custom mb-0">

            <thead>

                <tr>

                    <th style="width:50px;">
                        No
                    </th>

                    <th>
                        Nama Layanan
                    </th>

                    <th style="width:150px;">
                        Actions
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($pelayananList as $index => $pelayanan)

                    <tr>

                        <td>
                            {{ $index + 1 }}
                        </td>


                        <td>
                            {{ $pelayanan['nama_layanan'] ?? '-' }}
                        </td>


                        <td>

                            <div class="d-flex gap-2">

                                <a
                                    href="{{ route(
                                        'unit_layanan.pelayanan.edit',
                                        $pelayanan['id']
                                    ) }}"
                                    class="btn-action btn-edit text-decoration-none"
                                >
                                    Edit
                                </a>


                                <button
                                    type="button"
                                    class="btn-action btn-delete"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal"
                                    data-id="{{ $pelayanan['id'] }}"
                                    data-name="{{ $pelayanan['nama_layanan'] ?? 'data pelayanan ini' }}"
                                >
                                    Hapus
                                </button>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="3"
                            class="text-center text-muted py-5"
                        >

                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>

                            Belum ada data pelayanan.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


{{-- ================================================================ --}}
{{-- MODAL HAPUS --}}
{{-- ================================================================ --}}

<div
    class="modal fade"
    id="deleteModal"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Hapus Data Pelayanan
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <div class="modal-body">

                <p class="modal-description mb-0">

                    Apakah Anda yakin ingin menghapus
                    data pelayanan

                    <strong id="deleteServiceName"></strong>?

                </p>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-light rounded-pill px-4"
                    data-bs-dismiss="modal"
                >
                    Batal
                </button>


                <form
                    id="deleteForm"
                    method="POST"
                >

                    @csrf

                    @method('DELETE')


                    <button
                        type="submit"
                        class="btn-danger-custom"
                    >

                        <i class="bi bi-trash me-1"></i>

                        Ya, Hapus

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>


@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const deleteModal = document.getElementById('deleteModal');

    if (!deleteModal) {
        return;
    }


    deleteModal.addEventListener('show.bs.modal', function (event) {

        const button = event.relatedTarget;

        if (!button) {
            return;
        }


        const id = button.getAttribute('data-id');

        const name = button.getAttribute('data-name');


        const form = document.getElementById('deleteForm');

        const nameElement = document.getElementById('deleteServiceName');


        if (!form || !nameElement) {
            return;
        }


        form.action = '{{ url("unit-layanan/pelayanan") }}/' + id;

        nameElement.textContent = '"' + name + '"';

    });

});

</script>

@endpush

@endsection
