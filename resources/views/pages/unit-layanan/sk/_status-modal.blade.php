{{-- =========================================================
     MODAL UBAH STATUS SK
========================================================= --}}

<div
    class="modal fade"
    id="statusModal"
    tabindex="-1"
    aria-labelledby="statusModalTitle"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            {{-- HEADER --}}
            <div class="modal-header">

                <div>

                    <h5
                        class="modal-title"
                        id="statusModalTitle"
                    >
                        Ubah Status SK
                    </h5>

                    <p
                        class="modal-description mb-0 mt-1"
                        id="statusModalDescription"
                    >
                        Pilih status SK yang ingin digunakan.
                    </p>

                </div>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>

            </div>


            {{-- FORM --}}
            <form
                id="statusForm"
                method="POST"
                action=""
            >

                @csrf

                @method('PUT')


                <div class="modal-body">

                    <input
                        type="hidden"
                        id="statusSkId"
                        name="sk_id"
                    >


                    <div class="mb-3">

                        <label
                            for="statusSK"
                            class="form-label-custom"
                        >
                            Status SK
                        </label>


                        <select
                            id="statusSK"
                            name="status"
                            class="form-select"
                            required
                        >

                            <option value="">
                                Pilih Status
                            </option>

                            <option value="Aktif">
                                Aktif
                            </option>

                            <option value="Tidak Aktif">
                                Tidak Aktif
                            </option>

                        </select>

                    </div>

                </div>


                {{-- FOOTER --}}
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