<aside class="sidebar bg-primary text-white d-flex flex-column p-3" id="sidebar" style="width: 260px; min-height: 100vh; transition: width .2s;">

    {{-- Logo --}}
    <div class="d-flex align-items-center gap-2 mb-4 px-1">
        <div class="bg-white text-primary fw-bold rounded px-2 py-1 sidebar-logo-text">
            Logo
        </div>
    </div>

    <ul class="nav flex-column gap-1 flex-grow-1">
        <li class="nav-item">
            <a href="{{ Route::has('profile') ? route('profile') : '#' }}"
               class="nav-link text-white d-flex align-items-center gap-2 px-3 py-2 rounded {{ request()->routeIs('profile') ? 'bg-white bg-opacity-25 fw-semibold' : '' }}">
                <i class="bi bi-person-fill"></i> <span class="sidebar-label">Profile</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ Route::has('pelayanan.index') ? route('pelayanan.index') : '#' }}"
               class="nav-link text-white d-flex align-items-center gap-2 px-3 py-2 rounded {{ request()->routeIs('pelayanan.*') ? 'bg-white bg-opacity-25 fw-semibold' : '' }}">
                <i class="bi bi-people-fill"></i> <span class="sidebar-label">Nama Pelayanan</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="#submenuSK" data-bs-toggle="collapse" role="button"
               aria-expanded="{{ request()->routeIs('pengesahan_sk.*') ? 'true' : 'false' }}"
               class="nav-link text-white d-flex align-items-center gap-2 px-3 py-2 rounded">
                <i class="bi bi-file-earmark-text-fill"></i>
                <span class="sidebar-label">Pengesahan SK</span>
                <i class="bi bi-chevron-down ms-auto small sidebar-label"></i>
            </a>
            <div class="collapse {{ request()->routeIs('pengesahan_sk.*') ? 'show' : '' }}" id="submenuSK">
                <ul class="nav flex-column ms-4 mt-1 sidebar-label">
                    <li class="nav-item">
                        <a href="{{ Route::has('pengesahan_sk.index') ? route('pengesahan_sk.index') : '#' }}"
                           class="nav-link text-white px-3 py-2 rounded {{ request()->routeIs('pengesahan_sk.index') ? 'bg-white bg-opacity-25 fw-semibold' : '' }}">
                            Daftar SK
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ Route::has('pengesahan_sk.create') ? route('pengesahan_sk.create') : '#' }}"
                           class="nav-link text-white px-3 py-2 rounded {{ request()->routeIs('pengesahan_sk.create') ? 'bg-white bg-opacity-25 fw-semibold' : '' }}">
                            Ajukan SK
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>

    <ul class="nav flex-column">
        <li class="nav-item">
            <form method="POST" action="{{ Route::has('logout') ? route('logout') : '#' }}">
                @csrf
                <button type="submit" class="nav-link text-white bg-transparent border-0 d-flex align-items-center gap-2 px-3 py-2">
                    <i class="bi bi-box-arrow-right"></i> <span class="sidebar-label">Logout</span>
                </button>
            </form>
        </li>
    </ul>
</aside>