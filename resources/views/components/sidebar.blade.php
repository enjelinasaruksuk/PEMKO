<aside class="sidebar bg-primary text-white d-flex flex-column p-3" id="sidebar" style="width: 260px; min-height: 100vh; transition: width .2s;">

    {{-- Logo --}}
    <div class="d-flex align-items-center gap-2 mb-4 px-1">
        <div class="bg-white text-primary fw-bold rounded px-2 py-1 sidebar-logo-text">
            Logo
        </div>
    </div>

    <ul class="nav flex-column gap-1 flex-grow-1">

        <li class="nav-item">
            <a href="#submenuAkun" data-bs-toggle="collapse" role="button"
               aria-expanded="{{ request()->routeIs('pengguna.*') ? 'true' : 'false' }}"
               class="nav-link text-white d-flex align-items-center gap-2 px-3 py-2 rounded">
                <i class="bi bi-journal-bookmark-fill"></i>
                <span class="sidebar-label">Manajemen Akun</span>
                <i class="bi bi -chevron-down ms-auto small sidebar-label"></i>
            </a>
            <div class="collapse {{ request()->routeIs('pengguna.*') ? 'show' : '' }}" id="submenuAkun">
                <ul class="nav flex-column ms-4 mt-1 sidebar-label">
                    <li class="nav-item">
                        <a href="{{ route('pengguna.index') }}"
                           class="nav-link text-white px-3 py-2 rounded {{ request()->routeIs('pengguna.*') ? 'bg-white bg-opacity-25 fw-semibold' : '' }}">
                            Akun Pengguna
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a href="#submenuInstansi" data-bs-toggle="collapse" role="button"
               aria-expanded="{{ request()->routeIs('instansi.*') ? 'true' : 'false' }}"
               class="nav-link text-white d-flex align-items-center gap-2 px-3 py-2 rounded">
                <i class="bi bi-journal-bookmark-fill"></i>
                <span class="sidebar-label">Manajemen Instansi</span>
                <i class="bi bi-chevron-down ms-auto small sidebar-label"></i>
            </a>
            <div class="collapse {{ request()->routeIs('instansi.*') ? 'show' : '' }}" id="submenuInstansi">
                <ul class="nav flex-column ms-4 mt-1 sidebar-label">
                    <li class="nav-item">
                        <a href="{{ route('instansi.index') }}"
                           class="nav-link text-white px-3 py-2 rounded {{ request()->routeIs('instansi.*') ? 'bg-white bg-opacity-25 fw-semibold' : '' }}">
                            Instansi
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.pelayanan.index') }}"
               class="nav-link text-white d-flex align-items-center gap-2 px-3 py-2 rounded {{ request()->routeIs('admin.pelayanan.*') ? 'bg-white bg-opacity-25 fw-semibold' : '' }}">
                <i class="bi bi-people-fill"></i> <span class="sidebar-label">Pelayanan</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('sk.index') }}"
               class="nav-link text-white d-flex align-items-center gap-2 px-3 py-2 rounded {{ request()->routeIs('sk.*') ? 'bg-white bg-opacity-25 fw-semibold' : '' }}">
                <i class="bi bi-file-earmark-text-fill"></i> <span class="sidebar-label">SK</span>
            </a>
        </li>
    </ul>

    <ul class="nav flex-column">
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link text-white bg-transparent border-0 d-flex align-items-center gap-2 px-3 py-2">
                    <i class="bi bi-box-arrow-right"></i> <span class="sidebar-label">Logout</span>
                </button>
            </form>
        </li>
    </ul>
</aside>