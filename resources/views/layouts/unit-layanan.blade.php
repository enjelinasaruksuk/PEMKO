<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Standar Pelayanan Kota Batam')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/unit-layanan.css') }}" rel="stylesheet">

    @stack('styles')

</head>

<body>

    {{-- ================= HEADER ================= --}}
    <header class="top-header">

        <div class="logo-area" id="logoArea">
            <img
                src="{{ asset('images/logo.asap.png') }}"
                alt="ASAP"
                onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"
            >
            <span class="logo-placeholder" style="display:none;">ASAP</span>
        </div>

        <x-unit-layanan.navbar />

    </header>

    {{-- ================= BODY ================= --}}
    <div class="body-wrapper">

        <x-unit-layanan.sidebar />

        <div class="main-content">
            <main class="content-wrapper">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')

            </main>
        </div>

    </div>

    {{-- ================= DELETE CONFIRMATION MODAL ================= --}}
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body text-center p-4">
                    <div class="delete-warning-icon">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                    <h5 class="delete-modal-title" id="deleteConfirmModalLabel">Hapus Data?</h5>
                    <p class="delete-modal-text">
                        Apakah Anda yakin ingin menghapus data pelayanan ini?
                        <br>
                        Data yang sudah dihapus tidak dapat dikembalikan.
                    </p>
                </div>

                <div class="modal-footer justify-content-center gap-2">
                    <button type="button" class="btn-secondary-custom" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteConfirmForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger-custom">
                            <i class="bi bi-trash me-1"></i>
                            Ya, Hapus
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/unit-layanan.js') }}"></script>

    @stack('scripts')

</body>

</html>