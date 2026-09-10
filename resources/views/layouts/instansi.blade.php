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

    <header class="top-header">
        <div class="logo-area" id="logoArea">
            <img src="{{ asset('images/logo.asap.png') }}" alt="ASAP"
                 onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
            <span class="logo-placeholder" style="display:none;">ASAP</span>
        </div>

        <x-instansi.navbar />
    </header>

    <div class="body-wrapper">
        <x-instansi.sidebar />

        <div class="main-content">
            <main class="content-wrapper">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/unit-layanan.js') }}"></script>

    @stack('scripts')
</body>
</html>