<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Standar Pelayanan Kota Batam')
    </title>


    {{-- =========================================================
        BOOTSTRAP
    ========================================================== --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    {{-- =========================================================
        BOOTSTRAP ICONS
    ========================================================== --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >


    <style>

        /* =========================================================
           GLOBAL
        ========================================================== */

        :root {
            --primary: #2878d7;
            --primary-dark: #1768c5;
            --background: #f6f7fc;
            --text: #173b69;
            --danger: #e72c35;
            --border: #d8d8d8;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--background);
            font-family: Arial, Helvetica, sans-serif;
            color: var(--text);
        }

        .app-wrapper {
            min-height: 100vh;
        }


        /* =========================================================
           HEADER
        ========================================================== */

        .top-header {
            height: 64px;
            display: flex;
            background: #fff;
            box-shadow: 0 2px 7px rgba(0, 0, 0, .15);
            position: relative;
            z-index: 10;
        }


        .logo-area {
            width: 220px;
            min-width: 220px;
            height: 64px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #fff;

            transition: .2s;
            overflow: hidden;
        }


        .logo-area img {
            max-width: 145px;
            max-height: 48px;
            object-fit: contain;
        }


        .logo-area.collapsed {
            width: 75px;
            min-width: 75px;
        }


        .logo-area.collapsed img,
        .logo-area.collapsed .logo-placeholder {
            display: none;
        }


        .logo-placeholder {
            font-size: 28px;
            font-weight: 700;
            color: var(--primary-dark);
        }


        .navbar-area {
            flex: 1;
            height: 64px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 28px;
        }


        .sidebar-toggle {
            border: none;
            background: transparent;

            font-size: 25px;
            color: #222;

            padding: 0;
            line-height: 1;

            cursor: pointer;
        }


        .sidebar-toggle:hover {
            color: var(--primary);
        }


        .unit-badge {
            background: var(--primary);
            color: white;

            border-radius: 20px;

            padding: 7px 25px;

            font-size: 11px;
        }


        /* =========================================================
           BODY
        ========================================================== */

        .body-wrapper {
            display: flex;
            min-height: calc(100vh - 64px);
        }


        /* =========================================================
           SIDEBAR
        ========================================================== */

        .unit-sidebar {
            width: 220px;
            min-width: 220px;

            background: var(--primary);
            color: white;

            transition: .2s;

            display: flex;
            flex-direction: column;

            min-height: calc(100vh - 64px);
        }


        .unit-sidebar.collapsed {
            width: 75px;
            min-width: 75px;
        }


        .unit-sidebar .nav-area {
            padding: 20px 12px;
            flex-grow: 1;
        }


        .unit-sidebar .nav-link {
            color: white;

            font-size: 15px;

            border-radius: 6px;

            padding: 10px 14px;

            margin-bottom: 5px;

            text-decoration: none;

            transition: .2s;
        }


        .unit-sidebar .nav-link:hover,
        .unit-sidebar .nav-link.active {
            background: rgba(255, 255, 255, .15);
        }


        .sidebar-text {
            transition: .2s;
            white-space: nowrap;
        }


        .unit-sidebar.collapsed .sidebar-text {
            display: none;
        }


        .unit-sidebar.collapsed .nav-link {
            justify-content: center;
        }


        .unit-sidebar.collapsed .ms-auto {
            display: none;
        }


        .logout-area {
            padding: 15px 12px 25px;
        }


        /* =========================================================
           CONTENT
        ========================================================== */

        .main-content {
            flex: 1;
            min-width: 0;
        }


        .content-wrapper {
            padding: 24px;
        }


        .page-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--text);
        }


        .page-description {
            font-size: 11px;
            color: #b0b5c0;
        }


        /* =========================================================
           SECTION TITLE
        ========================================================== */

        .section-title {
            color: var(--text);

            font-size: 14px;
            font-weight: 700;

            margin-bottom: 20px;

            text-transform: uppercase;
        }


        /* =========================================================
           CARD
        ========================================================== */

        .card-custom {
            background: #fff;

            border: none;

            border-radius: 8px;

            box-shadow: 0 2px 7px rgba(0, 0, 0, .12);
        }


        /* =========================================================
           BUTTON
        ========================================================== */

        .btn-primary-custom {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            background: var(--primary);

            border: none;

            color: white;

            border-radius: 20px;

            padding: 7px 16px;

            font-size: 12px;

            text-decoration: none;

            cursor: pointer;

            transition: .2s;
        }


        .btn-primary-custom:hover {
            background: var(--primary-dark);
            color: white;
        }


        .btn-danger-custom {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            background: var(--danger);

            border: none;

            color: white;

            border-radius: 20px;

            padding: 7px 16px;

            font-size: 12px;

            cursor: pointer;
        }


        .btn-danger-custom:hover {
            background: #c9232b;
            color: white;
        }


        .btn-secondary-custom {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            background: #6c757d;

            border: none;

            color: white;

            border-radius: 20px;

            padding: 7px 16px;

            font-size: 12px;

            text-decoration: none;

            cursor: pointer;

            transition: .2s;
        }


        .btn-secondary-custom:hover {
            background: #5c636a;
            color: white;
        }


        .btn-back-custom {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;

            background: #fff;

            border: 1px solid #d8d8d8;

            color: var(--text);

            border-radius: 20px;

            padding: 7px 16px;

            font-size: 12px;

            text-decoration: none;

            cursor: pointer;

            transition: .2s;
        }


        .btn-back-custom:hover {
            background: #f1f3f5;
            color: var(--text);
        }


        /* =========================================================
           FORM
        ========================================================== */

        .form-label-custom {
            display: block;

            color: var(--text);

            font-size: 11px;

            margin-bottom: 5px;
        }


        .form-control,
        .form-select {
            border-radius: 4px;

            border: 1px solid var(--border);

            font-size: 13px;
        }


        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);

            box-shadow:
                0 0 0 .15rem
                rgba(40, 120, 215, .15);
        }


        /* =========================================================
           TABLE
        ========================================================== */

        .table-custom {
            font-size: 11px;

            vertical-align: middle;
        }


        .table-custom thead th {
            background: #f5f6f8;

            color: var(--text);

            font-weight: 600;

            white-space: nowrap;
        }


        .table-custom td {
            color: var(--text);
        }


        .btn-action {
            border: none;

            border-radius: 12px;

            color: #fff;

            font-size: 10px;

            padding: 3px 12px;

            cursor: pointer;

            text-decoration: none;

            display: inline-block;
        }


        .btn-edit {
            background: var(--primary);
        }


        .btn-edit:hover {
            background: var(--primary-dark);
            color: #fff;
        }


        .btn-delete {
            background: var(--danger);
        }


        .btn-delete:hover {
            background: #c9232b;
            color: #fff;
        }


        /* =========================================================
           ALERT
        ========================================================== */

        .alert {
            font-size: 12px;
        }


        /* =========================================================
           MODAL
        ========================================================== */

        .modal-content {
            border: none;

            border-radius: 7px;

            box-shadow:
                0 3px 15px
                rgba(0, 0, 0, .25);
        }


        .modal-header {
            border-bottom: 1px solid #eeeeee;

            padding: 18px 20px;
        }


        .modal-body {
            padding: 20px;
        }


        .modal-footer {
            border-top: 1px solid #eeeeee;

            padding: 15px 20px;
        }


        .modal-title {
            color: var(--text);

            font-size: 18px;

            font-weight: 700;
        }


        .modal-description {
            font-size: 11px;

            color: #222;

            line-height: 1.6;
        }


        .modal-field {
            background: #f1f1f1;

            border: none;

            border-radius: 4px;

            padding: 12px;
        }


        .delete-warning-icon {
            width: 50px;
            height: 50px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin: 0 auto 15px;

            border-radius: 50%;

            background: rgba(231, 44, 53, .1);

            color: var(--danger);

            font-size: 24px;
        }


        .delete-modal-title {
            color: var(--text);

            font-size: 17px;

            font-weight: 700;

            text-align: center;

            margin-bottom: 8px;
        }


        .delete-modal-text {
            color: #666;

            font-size: 12px;

            text-align: center;

            line-height: 1.6;

            margin-bottom: 0;
        }


        /* =========================================================
           RICH TEXT EDITOR
        ========================================================== */

        .rich-editor-wrapper {
            border: 1px solid var(--border);

            border-radius: 5px;

            background: #fff;

            overflow: hidden;
        }


        .rich-editor-toolbar {
            display: flex;

            align-items: center;

            flex-wrap: wrap;

            gap: 3px;

            padding: 7px;

            background: #f5f6f8;

            border-bottom: 1px solid var(--border);
        }


        .rich-editor-toolbar button {
            width: 30px;
            height: 30px;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            border: 1px solid transparent;

            background: transparent;

            color: #173b69;

            border-radius: 4px;

            cursor: pointer;

            font-size: 13px;
        }


        .rich-editor-toolbar button:hover {
            background: #e3e7ec;

            border-color: #d2d6db;
        }


        .rich-editor-toolbar button.active {
            background: #dce9f8;

            border-color: var(--primary);

            color: var(--primary-dark);
        }


        .rich-editor-toolbar .toolbar-divider {
            width: 1px;

            height: 22px;

            background: #d0d0d0;

            margin: 0 4px;
        }


        .rich-editor {
            min-height: 130px;

            padding: 12px;

            outline: none;

            color: #173b69;

            font-size: 13px;

            line-height: 1.6;

            background: #fff;
        }


        .rich-editor:focus {
            box-shadow:
                inset 0 0 0 1px
                rgba(40, 120, 215, .15);
        }


        .rich-editor:empty:before {
            content: attr(data-placeholder);

            color: #adb5bd;

            pointer-events: none;
        }


        .rich-editor p {
            margin-top: 0;
            margin-bottom: 8px;
        }


        .rich-editor ul,
        .rich-editor ol {
            padding-left: 25px;

            margin-bottom: 8px;
        }


        .rich-editor blockquote {
            border-left: 3px solid var(--primary);

            padding-left: 10px;

            margin-left: 0;

            color: #555;
        }


        /* =========================================================
           SEARCH
        ========================================================== */

        .search-box {
            max-width: 220px;
        }


        /* =========================================================
           EMPTY DATA
        ========================================================== */

        .empty-data {
            color: #8d939c;

            font-size: 12px;

            padding: 25px !important;
        }


        /* =========================================================
           PAGINATION
        ========================================================== */

        .pagination-custom {
            display: flex;

            justify-content: center;

            align-items: center;

            gap: 4px;

            margin-top: 20px;
        }


        .pagination-custom button {
            border: 1px solid #ddd;

            background: #fff;

            color: #555;

            border-radius: 4px;

            min-width: 30px;

            height: 30px;

            font-size: 11px;
        }


        .pagination-custom button:hover {
            background: #f1f3f5;
        }


        .pagination-custom button.active {
            background: var(--primary);

            color: white;

            border-color: var(--primary);
        }


        /* =========================================================
           RESPONSIVE
        ========================================================== */

        @media (max-width: 768px) {

            .logo-area {
                width: 160px;
                min-width: 160px;
            }


            .unit-sidebar {
                width: 180px;
                min-width: 180px;
            }


            .content-wrapper {
                padding: 16px;
            }


            .navbar-area {
                padding: 0 16px;
            }


            .unit-badge {
                padding: 7px 15px;
            }


            .search-box {
                max-width: 170px;
            }

        }

    </style>


    @stack('styles')

</head>


<body>


    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <header class="top-header">


        {{-- Logo --}}
        <div class="logo-area" id="logoArea">

            <img
                src="{{ asset('images/logo.asap.png') }}"
                alt="ASAP"
                onerror="
                    this.style.display='none';
                    this.nextElementSibling.style.display='block';
                "
            >


            <span
                class="logo-placeholder"
                style="display:none;"
            >
                ASAP
            </span>

        </div>


        {{-- Navbar --}}
        <div class="navbar-area">


            {{-- Sidebar Toggle --}}
            <button
                type="button"
                class="sidebar-toggle"
                id="sidebarToggle"
                aria-label="Toggle Sidebar"
            >

                <i class="bi bi-list"></i>

            </button>


            {{-- Unit --}}
            <span class="unit-badge">
                Organisasi
            </span>

        </div>

    </header>



    {{-- =========================================================
        BODY
    ========================================================== --}}

    <div class="body-wrapper">


        {{-- =====================================================
            SIDEBAR
        ====================================================== --}}

        <x-unit-layanan.sidebar />



        {{-- =====================================================
            MAIN CONTENT
        ====================================================== --}}

        <div class="main-content">


            <main class="content-wrapper">


                {{-- =================================================
                    SUCCESS MESSAGE
                ================================================== --}}

                @if(session('success'))

                    <div
                        class="alert alert-success alert-dismissible fade show"
                        role="alert"
                    >

                        {{ session('success') }}


                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Close"
                        ></button>

                    </div>

                @endif



                {{-- =================================================
                    ERROR MESSAGE
                ================================================== --}}

                @if($errors->any())

                    <div
                        class="alert alert-danger alert-dismissible fade show"
                        role="alert"
                    >

                        <ul class="mb-0">

                            @foreach($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>


                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Close"
                        ></button>

                    </div>

                @endif



                {{-- =================================================
                    PAGE CONTENT
                ================================================== --}}

                @yield('content')


            </main>


        </div>


    </div>



    {{-- =========================================================
        DELETE CONFIRMATION MODAL
        Modal ini bisa dipakai semua halaman.
    ========================================================== --}}

    <div
        class="modal fade"
        id="deleteConfirmModal"
        tabindex="-1"
        aria-labelledby="deleteConfirmModalLabel"
        aria-hidden="true"
    >

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">


                <div class="modal-body text-center p-4">


                    <div class="delete-warning-icon">

                        <i class="bi bi-exclamation-triangle"></i>

                    </div>


                    <h5
                        class="delete-modal-title"
                        id="deleteConfirmModalLabel"
                    >
                        Hapus Data?
                    </h5>


                    <p class="delete-modal-text">

                        Apakah Anda yakin ingin menghapus
                        data pelayanan ini?

                        <br>

                        Data yang sudah dihapus tidak dapat
                        dikembalikan.

                    </p>


                </div>


                <div class="modal-footer justify-content-center gap-2">


                    <button
                        type="button"
                        class="btn-secondary-custom"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>


                    <form
                        id="deleteConfirmForm"
                        method="POST"
                        action=""
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



    {{-- =========================================================
        BOOTSTRAP JS
    ========================================================== --}}

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    ></script>



    <script>

        document.addEventListener('DOMContentLoaded', function () {


            /* =====================================================
               SIDEBAR TOGGLE
            ====================================================== */

            const toggle =
                document.getElementById('sidebarToggle');

            const sidebar =
                document.querySelector('.unit-sidebar');

            const logoArea =
                document.getElementById('logoArea');


            if (toggle && sidebar) {

                toggle.addEventListener('click', function () {

                    sidebar.classList.toggle('collapsed');

                    if (logoArea) {

                        logoArea.classList.toggle('collapsed');

                    }

                });

            }



            /* =====================================================
               DELETE CONFIRMATION MODAL
            ====================================================== */

            const deleteModal =
                document.getElementById('deleteConfirmModal');

            const deleteForm =
                document.getElementById('deleteConfirmForm');


            if (deleteModal && deleteForm) {

                deleteModal.addEventListener(
                    'show.bs.modal',
                    function (event) {

                        const button =
                            event.relatedTarget;


                        if (!button) {
                            return;
                        }


                        const action =
                            button.getAttribute(
                                'data-delete-action'
                            );


                        if (action) {

                            deleteForm.setAttribute(
                                'action',
                                action
                            );

                        }

                    }
                );

            }



            /* =====================================================
               RICH TEXT EDITOR
            ====================================================== */

            const editors =
                document.querySelectorAll(
                    '[data-rich-editor]'
                );


            editors.forEach(function (editorWrapper) {


                const editor =
                    editorWrapper.querySelector(
                        '.rich-editor'
                    );


                const hiddenInput =
                    editorWrapper.querySelector(
                        'textarea[data-rich-value]'
                    );


                const toolbarButtons =
                    editorWrapper.querySelectorAll(
                        '[data-command]'
                    );


                if (!editor) {
                    return;
                }


                /*
                -----------------------------------------------------
                Load existing content
                -----------------------------------------------------
                */

                if (
                    hiddenInput &&
                    hiddenInput.value.trim() !== ''
                ) {

                    editor.innerHTML =
                        hiddenInput.value;

                }



                /*
                -----------------------------------------------------
                Toolbar command
                -----------------------------------------------------
                */

                toolbarButtons.forEach(function (button) {


                    button.addEventListener(
                        'mousedown',
                        function (event) {

                            /*
                            Mencegah editor kehilangan
                            selection ketika tombol toolbar
                            diklik.
                            */

                            event.preventDefault();

                        }
                    );


                    button.addEventListener(
                        'click',
                        function () {


                            const command =
                                button.getAttribute(
                                    'data-command'
                                );


                            const value =
                                button.getAttribute(
                                    'data-value'
                                );


                            editor.focus();


                            if (command === 'formatBlock') {

                                document.execCommand(
                                    command,
                                    false,
                                    value || 'p'
                                );

                            } else {

                                document.execCommand(
                                    command,
                                    false,
                                    value || null
                                );

                            }


                            updateEditorValue();

                            updateToolbarState();

                        }
                    );

                });



                /*
                -----------------------------------------------------
                Update hidden textarea
                -----------------------------------------------------
                */

                function updateEditorValue() {

                    if (hiddenInput) {

                        hiddenInput.value =
                            editor.innerHTML;

                    }

                }



                /*
                -----------------------------------------------------
                Update toolbar active state
                -----------------------------------------------------
                */

                function updateToolbarState() {

                    toolbarButtons.forEach(
                        function (button) {


                            const command =
                                button.getAttribute(
                                    'data-command'
                                );


                            if (
                                command === 'bold' ||
                                command === 'italic' ||
                                command === 'underline' ||
                                command === 'insertUnorderedList' ||
                                command === 'insertOrderedList'
                            ) {

                                try {

                                    const active =
                                        document.queryCommandState(
                                            command
                                        );


                                    button.classList.toggle(
                                        'active',
                                        active
                                    );

                                } catch (error) {

                                    // Abaikan command
                                    // yang tidak didukung browser.

                                }

                            }

                        }
                    );

                }



                /*
                -----------------------------------------------------
                Saat mengetik
                -----------------------------------------------------
                */

                editor.addEventListener(
                    'input',
                    function () {

                        updateEditorValue();

                    }
                );



                editor.addEventListener(
                    'keyup',
                    function () {

                        updateEditorValue();

                        updateToolbarState();

                    }
                );



                editor.addEventListener(
                    'mouseup',
                    function () {

                        updateToolbarState();

                    }
                );



                /*
                -----------------------------------------------------
                Paste
                -----------------------------------------------------
                */

                editor.addEventListener(
                    'paste',
                    function () {

                        setTimeout(function () {

                            updateEditorValue();

                        }, 0);

                    }
                );


            });



            /* =====================================================
               FORM SUBMIT
               Pastikan semua rich text sudah masuk textarea.
            ====================================================== */

            document
                .querySelectorAll('form')
                .forEach(function (form) {


                    form.addEventListener(
                        'submit',
                        function () {


                            form
                                .querySelectorAll(
                                    '[data-rich-editor]'
                                )
                                .forEach(
                                    function (editorWrapper) {


                                        const editor =
                                            editorWrapper.querySelector(
                                                '.rich-editor'
                                            );


                                        const hiddenInput =
                                            editorWrapper.querySelector(
                                                'textarea[data-rich-value]'
                                            );


                                        if (
                                            editor &&
                                            hiddenInput
                                        ) {

                                            hiddenInput.value =
                                                editor.innerHTML;

                                        }

                                    }
                                );

                        }
                    );

                });


        });

    </script>



    @stack('scripts')


</body>

</html>