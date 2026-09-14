<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Standar Pelayanan Kota Batam')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">

    @stack('styles')
</head>
<body class="auth-body">

    <div class="auth-header">
        <h1 class="auth-header-title">Standar Pelayanan Pemerintah Kota Batam</h1>
    </div>

    <div class="auth-wrapper">
        <div class="auth-card">

            @if ($errors->any())
                <div class="auth-alert auth-alert-danger">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    @if (session('success'))
        <div class="modal fade" id="authSuccessModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center p-4">
                        <div class="auth-success-icon">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        <h5 class="auth-success-title">Berhasil!</h5>
                        <p class="auth-success-text">{{ session('success') }}</p>
                        <button type="button" class="auth-submit-btn" data-bs-dismiss="modal">Oke, Mengerti</button>
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                new bootstrap.Modal(document.getElementById('authSuccessModal')).show();
            });
        </script>
        @endpush
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>