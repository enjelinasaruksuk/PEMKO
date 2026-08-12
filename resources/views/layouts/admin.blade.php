<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Standar Pelayanan Kota Batam')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body { background: #f4f6fb; }

        .sidebar .nav-link:hover { background: rgba(255,255,255,.15); }
        .sidebar .bi-chevron-down { transition: transform .2s; }
        .sidebar a[aria-expanded="true"] .bi-chevron-down { transform: rotate(180deg); }

        /* --- Collapse state --- */
        .sidebar.collapsed {
            width: 80px !important;
        }
        .sidebar.collapsed .sidebar-label {
            display: none;
        }
        .sidebar.collapsed .sidebar-logo-text {
            display: none;
        }
        .sidebar.collapsed .nav-link {
            justify-content: center;
        }
        .sidebar.collapsed ul.ms-4 {
            margin-left: 0 !important;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="d-flex">
        <x-sidebar />

        <div class="flex-grow-1">
            <x-navbar />
            <main class="p-4">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('collapsed');
        });
    </script>
    @stack('scripts')
</body>
</html>