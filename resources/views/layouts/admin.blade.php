<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Standar Pelayanan Kota Batam')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary: #2878d7;
            --primary-dark: #1768c5;
            --background: #f6f7fc;
            --text: #173b69;
            --danger: #e72c35;
            --border: #d8d8d8;
        }
        * { box-sizing: border-box; }
        body { margin: 0; background: var(--background); font-family: Arial, Helvetica, sans-serif; color: var(--text); }

        .top-header { height: 64px; display: flex; background: #fff; box-shadow: 0 2px 7px rgba(0,0,0,.15); position: relative; z-index: 10; }
        .logo-area { width: 220px; min-width: 220px; height: 64px; display: flex; align-items: center; justify-content: center; background: #fff; transition: .2s; overflow: hidden; }
        .logo-area img { max-width: 145px; max-height: 48px; object-fit: contain; }
        .logo-area.collapsed { width: 75px; min-width: 75px; }
        .logo-area.collapsed img, .logo-area.collapsed .logo-placeholder { display: none; }
        .logo-placeholder { font-size: 28px; font-weight: 700; color: var(--primary-dark); }

        .unit-navbar { flex: 1; height: 64px; display: flex; align-items: center; justify-content: space-between; padding: 0 28px; }
        .sidebar-toggle { border: none; background: transparent; font-size: 25px; color: #222; padding: 0; line-height: 1; cursor: pointer; }
        .sidebar-toggle:hover { color: var(--primary); }
        .unit-badge { background: var(--primary); color: white; border-radius: 20px; padding: 7px 25px; font-size: 11px; }

        .body-wrapper { display: flex; min-height: calc(100vh - 64px); }

        .unit-sidebar { width: 220px; min-width: 220px; background: var(--primary); color: white; transition: .2s; display: flex; flex-direction: column; min-height: calc(100vh - 64px); }
        .unit-sidebar.collapsed { width: 75px; min-width: 75px; }
        .unit-sidebar .nav-area { padding: 20px 12px; flex-grow: 1; }
        .unit-sidebar .nav-link { color: white; font-size: 15px; border-radius: 6px; padding: 10px 14px; margin-bottom: 5px; text-decoration: none; transition: .2s; }
        .unit-sidebar .nav-link:hover, .unit-sidebar .nav-link.active { background: rgba(255,255,255,.15); }
        .sidebar-text { transition: .2s; white-space: nowrap; }
        .unit-sidebar.collapsed .sidebar-text { display: none; }
        .unit-sidebar.collapsed .nav-link { justify-content: center; }
        .unit-sidebar.collapsed .ms-auto { display: none; }
        .logout-area { padding: 15px 12px 25px; }

        .main-content { flex: 1; min-width: 0; }
        .content-wrapper { padding: 24px; }

        .table-custom { font-size: 11px; vertical-align: middle; }
        .table-custom thead th { background: #f5f6f8; color: var(--text); font-weight: 600; white-space: nowrap; }
        .table-custom td { color: var(--text); }

        .btn-primary-custom { display: inline-flex; align-items: center; justify-content: center; background: var(--primary); border: none; color: white; border-radius: 20px; padding: 7px 16px; font-size: 12px; text-decoration: none; cursor: pointer; transition: .2s; }
        .btn-primary-custom:hover { background: var(--primary-dark); color: white; }
        .btn-danger-custom { display: inline-flex; align-items: center; justify-content: center; background: var(--danger); border: none; color: white; border-radius: 20px; padding: 7px 16px; font-size: 12px; cursor: pointer; }
        .btn-danger-custom:hover { background: #c9232b; color: white; }
        .btn-secondary-custom { display: inline-flex; align-items: center; justify-content: center; background: #6c757d; border: none; color: white; border-radius: 20px; padding: 7px 16px; font-size: 12px; text-decoration: none; cursor: pointer; transition: .2s; }
        .btn-secondary-custom:hover { background: #5c636a; color: white; }

        .modal-content { border: none; border-radius: 7px; box-shadow: 0 3px 15px rgba(0,0,0,.25); }
        .delete-warning-icon { width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; border-radius: 50%; background: rgba(231,44,53,.1); color: var(--danger); font-size: 24px; }
        .delete-modal-title { color: var(--text); font-size: 17px; font-weight: 700; text-align: center; margin-bottom: 8px; }
        .delete-modal-text { color: #666; font-size: 12px; text-align: center; line-height: 1.6; margin-bottom: 0; }

        .search-box { max-width: 220px; }
        .empty-data { color: #8d939c; font-size: 12px; padding: 25px !important; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .logo-area { width: 160px; min-width: 160px; }
            .unit-sidebar { width: 180px; min-width: 180px; }
            .content-wrapper { padding: 16px; }
            .unit-navbar { padding: 0 16px; }
            .unit-badge { padding: 7px 15px; }
            .search-box { max-width: 170px; }
        }
    </style>

    @stack('styles')
</head>
<body>

    <header class="top-header">
        <div class="logo-area" id="logoArea">
            <img src="{{ asset('images/logo.asap.png') }}" alt="ASAP"
                 onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
            <span class="logo-placeholder" style="display:none;">ASAP</span>
        </div>

        <x-admin.navbar />
    </header>

    <div class="body-wrapper">
        <x-admin.sidebar />

        <div class="main-content">
            <main class="content-wrapper">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')

            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggle = document.getElementById('sidebarToggle');
            const sidebar = document.querySelector('.unit-sidebar');
            const logoArea = document.getElementById('logoArea');

            if (toggle && sidebar) {
                toggle.addEventListener('click', function () {
                    sidebar.classList.toggle('collapsed');
                    if (logoArea) logoArea.classList.toggle('collapsed');
                });
            }
        });
    </script>

    @stack('scripts')
</body>
</html>