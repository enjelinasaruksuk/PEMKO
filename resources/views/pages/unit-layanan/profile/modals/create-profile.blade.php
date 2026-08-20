<div
    class="modal fade"
    id="createProfileModal"
    tabindex="-1"
    aria-labelledby="createProfileModalLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered modal-xl">

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


            <form id="profileForm">

                <div class="modal-body">

                    <div class="row g-4">

                        {{-- Kolom 1 --}}
                        <div class="col-md-4">

                            <div class="mb-3">
                                <label class="form-label-custom">
                                    Nama Unit Layanan
                                </label>

                                <input
                                    type="text"
                                    name="nama_unit_layanan"
                                    class="form-control"
                                    placeholder="Masukkan nama unit layanan"
                                >
                            </div>


                            <div class="mb-3">
                                <label class="form-label-custom">
                                    Nama Kepala Dinas/UUP
                                </label>

                                <input
                                    type="text"
                                    name="nama_kepala"
                                    class="form-control"
                                    placeholder="Masukkan nama kepala"
                                >
                            </div>


                            <div class="mb-3">
                                <label class="form-label-custom">
                                    Jabatan
                                </label>

                                <select name="jabatan" class="form-select">

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


                            <div class="mb-3">
                                <label class="form-label-custom">
                                    Laman (Website)
                                </label>

                                <input
                                    type="text"
                                    name="website"
                                    class="form-control"
                                    placeholder="Masukkan website"
                                >
                            </div>


                            <div class="mb-3">
                                <label class="form-label-custom">
                                    Alamat
                                </label>

                                <textarea
                                    name="alamat"
                                    class="form-control"
                                    rows="4"
                                    placeholder="Masukkan alamat"
                                ></textarea>
                            </div>


                            {{-- List Perda (diisi via modal Tambah Perda, lalu disimpan ke database) --}}
                            <div class="mb-3">
                                <label class="form-label-custom">
                                    Perda
                                </label>

                                <div id="perdaList" data-source="database">
                                    {{-- Item akan muncul di sini, diisi dari data Perda yang sudah ditambahkan lewat halaman/tombol Tambah Perda --}}
                                </div>
                            </div>

                        </div>


                        {{-- Kolom 2 --}}
                        <div class="col-md-4">

                            <div class="mb-3">
                                <label class="form-label-custom">
                                    NIP
                                </label>

                                <input
                                    type="text"
                                    name="nip"
                                    class="form-control"
                                    placeholder="Masukkan NIP"
                                >
                            </div>


                            <div class="mb-3">
                                <label class="form-label-custom">
                                    Pangkat
                                </label>

                                <input
                                    type="text"
                                    name="pangkat"
                                    class="form-control"
                                    placeholder="Masukkan pangkat"
                                >
                            </div>


                            <div class="mb-3">
                                <label class="form-label-custom">
                                    Pos-el/Email
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="Masukkan email"
                                >
                            </div>


                            <div class="mb-3">
                                <label class="form-label-custom">
                                    Misi
                                </label>

                                <textarea
                                    name="misi"
                                    class="form-control"
                                    rows="4"
                                    placeholder="Masukkan misi"
                                ></textarea>
                            </div>


                            {{-- List Perwali (diisi via modal Tambah Perwali, lalu disimpan ke database) --}}
                            <div class="mb-3">
                                <label class="form-label-custom">
                                    Perwali
                                </label>

                                <div id="perwaliList" data-source="database">
                                    {{-- Item akan muncul di sini, diisi dari data Perwali yang sudah ditambahkan lewat halaman/tombol Tambah Perwali --}}
                                </div>
                            </div>

                        </div>


                        {{-- Kolom 3 --}}
                        <div class="col-md-4">

                            <div class="mb-3">
                                <label class="form-label-custom">
                                    Telepon
                                </label>

                                <input
                                    type="text"
                                    name="telepon"
                                    class="form-control"
                                    placeholder="Masukkan nomor telepon"
                                >
                            </div>


                            <div class="mb-3">
                                <label class="form-label-custom">
                                    Faksimile
                                </label>

                                <input
                                    type="text"
                                    name="faksimile"
                                    class="form-control"
                                    placeholder="Masukkan faksimile"
                                >
                            </div>


                            <div class="mb-3">
                                <label class="form-label-custom">
                                    Motto
                                </label>

                                <textarea
                                    name="motto"
                                    class="form-control"
                                    rows="2"
                                    placeholder="Masukkan motto"
                                ></textarea>
                            </div>


                            <div class="mb-3">
                                <label class="form-label-custom">
                                    Visi
                                </label>

                                <textarea
                                    name="visi"
                                    class="form-control"
                                    rows="4"
                                    placeholder="Masukkan visi"
                                ></textarea>
                            </div>


                            {{-- List Maklumat (diisi via modal Tambah Maklumat, lalu disimpan ke database) --}}
                            <div class="mb-3">
                                <label class="form-label-custom">
                                    Maklumat
                                </label>

                                <div id="maklumatList" data-source="database">
                                    {{-- Item akan muncul di sini, diisi dari data Maklumat yang sudah ditambahkan lewat halaman/tombol Tambah Maklumat --}}
                                </div>
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


<style>
    /* Tampilan teks item list, meniru gaya form-control tapi readonly */
    .list-item-text {
        display: block;
        padding: 0.375rem 0.75rem;
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
        background-color: #f8f9fa;
        word-break: break-word;
    }
</style>


<script>
    // Menambahkan satu item (nomor + teks + input hidden untuk submit form + tombol hapus)
    function appendListItem(containerId, inputName, value) {
        const container = document.getElementById(containerId);
        const itemCount = container.querySelectorAll('.list-item').length + 1;

        const item = document.createElement('div');
        item.className = 'd-flex align-items-center gap-2 mb-2 list-item';

        const numberSpan = document.createElement('span');
        numberSpan.className = 'item-number';
        numberSpan.textContent = `${itemCount}.`;

        const textSpan = document.createElement('span');
        textSpan.className = 'list-item-text flex-grow-1';
        textSpan.textContent = value;

        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = inputName;
        hiddenInput.value = value;

        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'btn btn-sm btn-outline-danger remove-item';
        removeBtn.innerHTML = '&times;';
        removeBtn.addEventListener('click', function () {
            removeListItem(removeBtn, containerId);
        });

        item.appendChild(numberSpan);
        item.appendChild(textSpan);
        item.appendChild(hiddenInput);
        item.appendChild(removeBtn);

        container.appendChild(item);
    }

    // Hapus item dari list, lalu susun ulang nomor urut
    function removeListItem(button, containerId) {
        button.closest('.list-item').remove();
        renumberList(containerId);
    }

    // Susun ulang nomor urut (1, 2, 3, ...) setelah ada item yang dihapus
    function renumberList(containerId) {
        const container = document.getElementById(containerId);
        const items = container.querySelectorAll('.list-item');

        items.forEach((item, index) => {
            item.querySelector('.item-number').textContent = `${index + 1}.`;
        });
    }

    // Mengisi list dari data database (dipanggil saat modal dibuka untuk edit data)
    // Format data yang diharapkan: array string, misal ['Perda No 1 Tahun 2020', 'Perda No 2 Tahun 2021']
    function fillListFromDatabase(containerId, inputName, dataArray) {
        const container = document.getElementById(containerId);
        container.innerHTML = '';

        if (!dataArray || dataArray.length === 0) {
            return;
        }

        dataArray.forEach((value) => {
            appendListItem(containerId, inputName, value);
        });
    }

    // Contoh pemanggilan saat modal profil dibuka (baik untuk tambah maupun edit data):
    // Data Perda, Perwali, dan Maklumat didapat dari halaman/tombol tambah masing-masing
    // (di luar modal ini), lalu ditampilkan di sini sebagai list bernomor.
    // fillListFromDatabase('perdaList', 'perda[]', dataProfil.perda);
    // fillListFromDatabase('perwaliList', 'perwali[]', dataProfil.perwali);
    // fillListFromDatabase('maklumatList', 'maklumat[]', dataProfil.maklumat);
</script>