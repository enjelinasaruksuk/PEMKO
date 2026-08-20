@extends('layouts.unit-layanan')

@section('title', 'Peraturan')

@section('content')

<div class="d-flex justify-content-between align-items-start mb-4">

    <div>
        <h1 class="page-title mb-1">
            Peraturan
        </h1>

        <p class="page-description mb-0">
            Data Peraturan Daerah dan Peraturan Wali Kota.
        </p>
    </div>

    <a
        href="{{ route('unit_layanan.profile') }}"
        class="btn btn-light"
    >
        <i class="bi bi-arrow-left me-1"></i>
        Kembali
    </a>

</div>


{{-- =========================================================
     PERATURAN DAERAH
========================================================= --}}

<div class="card-custom p-4 mb-4">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>
            <h2 class="page-title mb-1">
                Peraturan Daerah
            </h2>

            <p class="page-description mb-0">
                Daftar Peraturan Daerah.
            </p>
        </div>

        <button
            type="button"
            class="btn-primary-custom"
            data-bs-toggle="modal"
            data-bs-target="#tambahPerdaModal"
        >
            <i class="bi bi-plus-circle me-1"></i>
            Tambah Perda
        </button>

    </div>


    {{-- Data Perda --}}

    @forelse(($perda ?? []) as $item)

        <div class="border rounded p-3 mb-2">

            <div class="d-flex align-items-center gap-2">

                <i class="bi bi-file-earmark-text"></i>

                <span>
                    {{ $item }}
                </span>

            </div>

        </div>

    @empty

        <div class="text-center text-muted py-4">

            <i class="bi bi-file-earmark-text fs-3"></i>

            <div class="small mt-2">
                Belum ada Peraturan Daerah.
            </div>

        </div>

    @endforelse

</div>



{{-- =========================================================
     PERATURAN WALI KOTA
========================================================= --}}

<div class="card-custom p-4">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>
            <h2 class="page-title mb-1">
                Peraturan Wali Kota
            </h2>

            <p class="page-description mb-0">
                Daftar Peraturan Wali Kota.
            </p>
        </div>

        <button
            type="button"
            class="btn-primary-custom"
            data-bs-toggle="modal"
            data-bs-target="#tambahPerwaliModal"
        >
            <i class="bi bi-plus-circle me-1"></i>
            Tambah Perwali
        </button>

    </div>


    {{-- Data Perwali --}}

    @forelse(($perwali ?? []) as $item)

        <div class="border rounded p-3 mb-2">

            <div class="d-flex align-items-center gap-2">

                <i class="bi bi-file-earmark-text"></i>

                <span>
                    {{ $item }}
                </span>

            </div>

        </div>

    @empty

        <div class="text-center text-muted py-4">

            <i class="bi bi-file-earmark-text fs-3"></i>

            <div class="small mt-2">
                Belum ada Peraturan Wali Kota.
            </div>

        </div>

    @endforelse

</div>



{{-- =========================================================
     MODAL TAMBAH PERDA
========================================================= --}}

<div
    class="modal fade"
    id="tambahPerdaModal"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content">

            <form
                method="POST"
                action="#"
            >

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title">
                        Tambah Peraturan Daerah
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>


                <div class="modal-body">

                    <p class="modal-description mb-3">
                        Tambahkan Peraturan Daerah.
                    </p>

                    <div>

                        <label class="form-label-custom">
                            Peraturan Daerah
                        </label>

                        <textarea
                            name="perda"
                            class="form-control modal-field"
                            placeholder="Masukkan Peraturan Daerah"
                            rows="5"
                            style="resize: vertical; min-height: 120px;"
                        ></textarea>

                    </div>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn-primary-custom"
                    >
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>



{{-- =========================================================
     MODAL TAMBAH PERWALI
========================================================= --}}

<div
    class="modal fade"
    id="tambahPerwaliModal"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content">

            <form
                method="POST"
                action="#"
            >

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title">
                        Tambah Peraturan Wali Kota
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>


                <div class="modal-body">

                    <p class="modal-description mb-3">
                        Tambahkan Peraturan Wali Kota.
                    </p>

                    <div>

                        <label class="form-label-custom">
                            Peraturan Wali Kota
                        </label>

                        <textarea
                            name="perwali"
                            class="form-control modal-field"
                            placeholder="Masukkan Peraturan Wali Kota"
                            rows="5"
                            style="resize: vertical; min-height: 120px;"
                        ></textarea>

                    </div>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn-primary-custom"
                    >
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection