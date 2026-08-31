<aside class="unit-sidebar">

    <div class="nav-area">

      

        {{-- ==========================================================
             MANAJEMEN AKUN
        =========================================================== --}}
        
        <a
            href="#akunMenu"
            class="nav-link d-flex align-items-center gap-2"
            data-bs-toggle="collapse"
            role="button"
            aria-expanded="{{ request()->routeIs('admin.pengguna.*') ? 'true' : 'false' }}"
            aria-controls="akunMenu"
        >
            <i class="bi bi-people"></i>
            <span class="sidebar-text">Manajemen Akun</span>
            <i class="bi bi-chevron-down ms-auto sidebar-text" style="font-size: 11px;"></i>
        </a>

        <div class="collapse {{ request()->routeIs('admin.pengguna.*') ? 'show' : '' }}" id="akunMenu">
            
            <a
                href="{{ route('admin.pengguna.index') }}"
                class="nav-link d-flex align-items-center gap-2 ps-5 {{ request()->routeIs('admin.pengguna.*') ? 'active' : '' }}"
                style="font-size: 13px;"
            >
                <i class="bi bi-dot"></i>
                <span class="sidebar-text">Akun Pengguna</span>
            </a>
        </div>

        {{-- ==========================================================
             MANAJEMEN INSTANSI
        =========================================================== --}}
        
        <a
            href="#instansiMenu"
            class="nav-link d-flex align-items-center gap-2"
            data-bs-toggle="collapse"
            role="button"
            aria-expanded="{{ request()->routeIs('admin.instansi.*') ? 'true' : 'false' }}"
            aria-controls="instansiMenu"
        >
            <i class="bi bi-building"></i>
            <span class="sidebar-text">Manajemen Instansi</span>
            <i class="bi bi-chevron-down ms-auto sidebar-text" style="font-size: 11px;"></i>
        </a>

        <div class="collapse {{ request()->routeIs('admin.instansi.*') ? 'show' : '' }}" id="instansiMenu">
            
            <a
                href="{{ route('admin.instansi.index') }}"
                class="nav-link d-flex align-items-center gap-2 ps-5 {{ request()->routeIs('admin.instansi.*') ? 'active' : '' }}"
                style="font-size: 13px;"
            >
                <i class="bi bi-dot"></i>
                <span class="sidebar-text">Instansi</span>
            </a>
        </div>

        {{-- ==========================================================
             PELAYANAN
        =========================================================== --}}
        
        <a
            href="{{ route('admin.pelayanan.index') }}"
            class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('admin.pelayanan.*') ? 'active' : '' }}"
        >
            <i class="bi bi-list-check"></i>
            <span class="sidebar-text">Pelayanan</span>
        </a>

        {{-- ==========================================================
             SK
        =========================================================== --}}
        
        <a
            href="{{ route('admin.sk.index') }}"
            class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('admin.sk.*') ? 'active' : '' }}"
        >
            <i class="bi bi-file-earmark-text"></i>
            <span class="sidebar-text">SK</span>
        </a>

    </div>

    {{-- ==========================================================
         LOGOUT
    =========================================================== --}}
    <div class="logout-area">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-link d-flex align-items-center gap-2 bg-transparent border-0 w-100 text-start">
                <i class="bi bi-box-arrow-right"></i>
                <span class="sidebar-text">Logout</span>
            </button>
        </form>
    </div>

</aside>