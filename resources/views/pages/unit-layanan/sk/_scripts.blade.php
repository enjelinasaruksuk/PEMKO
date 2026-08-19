<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | ELEMENT
    |--------------------------------------------------------------------------
    */

    const skModal = document.getElementById('skModal');

    const skForm = document.getElementById('skForm');

    const skModalTitle = document.getElementById('skModalTitle');

    const skModalDescription =
        document.getElementById('skModalDescription');

    const skMethod =
        document.getElementById('skMethod');

    const noSK =
        document.getElementById('noSK');

    const tanggalSK =
        document.getElementById('tanggalSK');

    const jenisSK =
        document.getElementById('jenisSK');

    const noSkSebelumnyaWrapper =
        document.getElementById('noSkSebelumnyaWrapper');

    const noSkSebelumnya =
        document.getElementById('noSkSebelumnya');


    /*
    |--------------------------------------------------------------------------
    | ROUTE
    |--------------------------------------------------------------------------
    */

    const baseUrl =
        "{{ url('/unit-layanan/pengesahan-sk') }}";


    /*
    |--------------------------------------------------------------------------
    | JENIS SK
    |--------------------------------------------------------------------------
    */

    function togglePreviousSK() {

        if (
            jenisSK.value ===
            'Menggantikan SK Sebelumnya'
        ) {

            noSkSebelumnyaWrapper.style.display = 'block';

            noSkSebelumnya.required = true;

        } else {

            noSkSebelumnyaWrapper.style.display = 'none';

            noSkSebelumnya.required = false;

            noSkSebelumnya.value = '';

        }

    }


    jenisSK.addEventListener(
        'change',
        togglePreviousSK
    );


    /*
    |--------------------------------------------------------------------------
    | MODAL TAMBAH / EDIT
    |--------------------------------------------------------------------------
    */

    if (skModal) {

        skModal.addEventListener(
            'show.bs.modal',
            function (event) {

                const button =
                    event.relatedTarget;

                /*
                |--------------------------------------------------------------------------
                | TAMBAH
                |--------------------------------------------------------------------------
                */

                if (
                    !button ||
                    !button.hasAttribute('data-sk-id')
                ) {

                    skModalTitle.textContent =
                        'Tambah SK';

                    skModalDescription.textContent =
                        'Isilah form di bawah ini untuk menambah data SK baru.';

                    skForm.action =
                        "{{ route('unit_layanan.sk.store') }}";

                    skMethod.value =
                        'POST';

                    noSK.value = '';

                    tanggalSK.value = '';

                    jenisSK.value = '';

                    noSkSebelumnya.value = '';

                    togglePreviousSK();

                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | EDIT
                |--------------------------------------------------------------------------
                */

                const id =
                    button.getAttribute(
                        'data-sk-id'
                    );

                const no =
                    button.getAttribute(
                        'data-no-sk'
                    );

                const tanggal =
                    button.getAttribute(
                        'data-tanggal-sk'
                    );

                const jenis =
                    button.getAttribute(
                        'data-jenis-sk'
                    );

                const previous =
                    button.getAttribute(
                        'data-no-sk-sebelumnya'
                    );


                skModalTitle.textContent =
                    'Edit SK';

                skModalDescription.textContent =
                    'Perbarui informasi data SK di bawah ini.';


                skForm.action =
                    `${baseUrl}/${id}`;


                skMethod.value =
                    'PUT';


                noSK.value =
                    no || '';


                tanggalSK.value =
                    tanggal || '';


                jenisSK.value =
                    jenis || '';


                noSkSebelumnya.value =
                    previous || '';


                togglePreviousSK();

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | MODAL STATUS
    |--------------------------------------------------------------------------
    */

    const statusModal =
        document.getElementById('statusModal');

    const statusForm =
        document.getElementById('statusForm');

    const statusSkId =
        document.getElementById('statusSkId');

    const statusSK =
        document.getElementById('statusSK');


    if (statusModal) {

        statusModal.addEventListener(
            'show.bs.modal',
            function (event) {

                const button =
                    event.relatedTarget;

                if (!button) {
                    return;
                }


                const id =
                    button.getAttribute(
                        'data-status-id'
                    );

                const status =
                    button.getAttribute(
                        'data-status'
                    );


                statusSkId.value =
                    id || '';


                statusSK.value =
                    status || '';


                statusForm.action =
                    `${baseUrl}/${id}/status`;

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    const deleteModal =
        document.getElementById('deleteSKModal');

    const deleteForm =
        document.getElementById('deleteSKForm');


    if (deleteModal) {

        deleteModal.addEventListener(
            'show.bs.modal',
            function (event) {

                const button =
                    event.relatedTarget;

                if (!button) {
                    return;
                }


                const id =
                    button.getAttribute(
                        'data-delete-id'
                    );


                deleteForm.action =
                    `${baseUrl}/${id}`;

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | SEARCH
    |--------------------------------------------------------------------------
    */

    const searchInput =
        document.getElementById('skSearch');

    const tableBody =
        document.getElementById('skTableBody');


    if (
        searchInput &&
        tableBody
    ) {

        searchInput.addEventListener(
            'input',
            function () {

                const keyword =
                    this.value
                        .toLowerCase()
                        .trim();


                const rows =
                    tableBody.querySelectorAll('tr');


                rows.forEach(function (row) {

                    const text =
                        row.textContent
                            .toLowerCase();


                    if (!keyword) {

                        row.style.display =
                            '';

                        return;

                    }


                    row.style.display =
                        text.includes(keyword)
                            ? ''
                            : 'none';

                });

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | CHEVRON
    |--------------------------------------------------------------------------
    */

    const chevronButton =
        document.querySelector(
            '.sk-chevron-button'
        );

    const tableCard =
        document.querySelector(
            '.sk-card'
        );

    const sectionHeader =
        document.querySelector(
            '.sk-section-header'
        );

    const divider =
        document.querySelector(
            '.sk-divider'
        );


    if (
        chevronButton &&
        tableCard &&
        sectionHeader &&
        divider
    ) {

        chevronButton.addEventListener(
            'click',
            function () {

                const icon =
                    this.querySelector('i');


                const hidden =
                    tableCard.style.display ===
                    'none';


                if (hidden) {

                    tableCard.style.display =
                        '';

                    sectionHeader.style.display =
                        '';

                    divider.style.display =
                        '';

                    icon.className =
                        'bi bi-chevron-down';

                } else {

                    tableCard.style.display =
                        'none';

                    sectionHeader.style.display =
                        'none';

                    icon.className =
                        'bi bi-chevron-right';

                }

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | DETAIL
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll(
            '[data-detail-id]'
        )
        .forEach(function (button) {

            button.addEventListener(
                'click',
                function () {

                    const id =
                        this.getAttribute(
                            'data-detail-id'
                        );

                    console.log(
                        'Detail SK:',
                        id
                    );

                    alert(
                        'Detail SK ID: ' + id
                    );

                }
            );

        });


    /*
    |--------------------------------------------------------------------------
    | PDF
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll(
            '[data-pdf-id]'
        )
        .forEach(function (button) {

            button.addEventListener(
                'click',
                function () {

                    const id =
                        this.getAttribute(
                            'data-pdf-id'
                        );

                    console.log(
                        'PDF SK:',
                        id
                    );

                    alert(
                        'Fitur PDF untuk SK ID ' +
                        id +
                        ' belum tersedia.'
                    );

                }
            );

        });


    /*
    |--------------------------------------------------------------------------
    | KONFIRMASI
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll(
            '[data-confirmation-id]'
        )
        .forEach(function (button) {

            button.addEventListener(
                'click',
                function () {

                    const id =
                        this.getAttribute(
                            'data-confirmation-id'
                        );

                    console.log(
                        'Konfirmasi SK:',
                        id
                    );

                    alert(
                        'Konfirmasi SK ID ' +
                        id
                    );

                }
            );

        });

});

</script>