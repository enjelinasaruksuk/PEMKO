<div
    class="modal fade"
    id="createProfileModal"
    tabindex="-1"
    aria-labelledby="createProfileModalLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <div>

                    <h5
                        class="modal-title"
                        id="createProfileModalLabel"
                    >
                        Tambah Data Profil
                    </h5>

                    <p class="modal-description mb-0">
                        Isilah form berikut untuk menambahkan
                        data profil unit layanan.
                    </p>

                </div>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <form>

                <div class="modal-body">

                    <div class="row g-3">

                        {{-- Kolom 1 --}}
                        <div class="col-md-4">

                            <div>
                                <label class="form-label-custom">
                                    Nama Unit Layanan
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Masukkan nama unit layanan"
                                >
                            </div>


                            <div>
                                <label class="form-label-custom">
                                    Nama Kepala Dinas/UUP
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Masukkan nama kepala"
                                >
                            </div>


                            <div>
                                <label class="form-label-custom">
                                    Jabatan
                                </label>

                                <select class="form-select">

                                    <option value="">
                                        Pilih Jabatan
                                    </option>

                                    <option value="Non PLT">
                                        Non PLT
                                    </option>

                                    <option value="PLT">
                                        PLT
                                    </option>

                                </select>

                            </div>


                            <div>
                                <label class="form-label-custom">
                                    Laman (Website)
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Masukkan website"
                                >
                            </div>

                        </div>


                        {{-- Kolom 2 --}}
                        <div class="col-md-4">

                            <div>
                                <label class="form-label-custom">
                                    Alamat
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Masukkan alamat"
                                >
                            </div>


                            <div>
                                <label class="form-label-custom">
                                    NIP
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Masukkan NIP"
                                >
                            </div>


                            <div>
                                <label class="form-label-custom">
                                    Pangkat
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Masukkan pangkat"
                                >
                            </div>


                            <div>
                                <label class="form-label-custom">
                                    Misi
                                </label>

                                <textarea
                                    class="form-control"
                                    rows="2"
                                    placeholder="Masukkan misi"
                                ></textarea>
                            </div>


                            <div>
                                <label class="form-label-custom">
                                    Pos-el/Email
                                </label>

                                <input
                                    type="email"
                                    class="form-control"
                                    placeholder="Masukkan email"
                                >
                            </div>

                        </div>


                        {{-- Kolom 3 --}}
                        <div class="col-md-4">

                            <div>
                                <label class="form-label-custom">
                                    Telepon
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Masukkan nomor telepon"
                                >
                            </div>


                            <div>
                                <label class="form-label-custom">
                                    Faksimile
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Masukkan faksimile"
                                >
                            </div>


                            <div>
                                <label class="form-label-custom">
                                    Motto
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Masukkan motto"
                                >
                            </div>


                            <div>
                                <label class="form-label-custom">
                                    Visi
                                </label>

                                <textarea
                                    class="form-control"
                                    rows="2"
                                    placeholder="Masukkan visi"
                                ></textarea>
                            </div>

                        </div>

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
                        type="button"
                        class="btn-primary-custom"
                    >
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>