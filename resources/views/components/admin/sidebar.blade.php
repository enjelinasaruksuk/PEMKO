<aside class="unit-sidebar">

    <div class="nav-area">

        <a href="#akunMenu" class="nav-link nav-parent d-flex align-items-center gap-2" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs('admin.pengguna.*') ? 'true' : 'false' }}" aria-controls="akunMenu">
            <i class="bi bi-people"></i>
            <span class="sidebar-text">Manajemen Akun</span>
            <i class="bi bi-plus-lg ms-auto sidebar-text nav-parent-icon"></i>
        </a>

        <div class="collapse submenu {{ request()->routeIs('admin.pengguna.*') ? 'show' : '' }}" id="akunMenu">
            <a href="{{ route('admin.pengguna.index') }}" class="submenu-link {{ request()->routeIs('admin.pengguna.*') ? 'active' : '' }}">
                <span class="sidebar-text">Akun Pengguna</span>
            </a>
        </div>

        <a href="#instansiMenu" class="nav-link nav-parent d-flex align-items-center gap-2" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs('admin.instansi.*') || request()->routeIs('admin.instansi_pengajuan.*') ? 'true' : 'false' }}" aria-controls="instansiMenu">
            <i class="bi bi-building"></i>
            <span class="sidebar-text">Manajemen Instansi</span>
            <i class="bi bi-plus-lg ms-auto sidebar-text nav-parent-icon"></i>
        </a>

        <div class="collapse submenu {{ request()->routeIs('admin.instansi.*') || request()->routeIs('admin.instansi_pengajuan.*') ? 'show' : '' }}" id="instansiMenu">
            <a href="{{ route('admin.instansi.index') }}" class="submenu-link {{ request()->routeIs('admin.instansi.*') ? 'active' : '' }}">
                <span class="sidebar-text">Instansi</span>
            </a>
            <a href="{{ route('admin.instansi_pengajuan.index') }}" class="submenu-link {{ request()->routeIs('admin.instansi_pengajuan.*') ? 'active' : '' }}">
                <span class="sidebar-text">Pengajuan Akun</span>
            </a>
        </div>

        <a href="{{ route('admin.pelayanan.index') }}" class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('admin.pelayanan.*') ? 'active' : '' }}">
            <i class="bi bi-list-check"></i>
            <span class="sidebar-text">Pelayanan</span>
        </a>

        <a href="{{ route('admin.sk.index') }}" class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('admin.sk.*') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-text"></i>
            <span class="sidebar-text">SK</span>
        </a>

        <a href="{{ route('admin.maklumat.index') }}" class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('admin.maklumat.*') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-check"></i>
            <span class="sidebar-text">Maklumat</span>
        </a>

    </div>

        <div class="logout-area">
        <button type="button" class="nav-link d-flex align-items-center gap-2 bg-transparent border-0 w-100 text-start"
                data-bs-toggle="modal" data-bs-target="#logoutModal">
            <i class="bi bi-box-arrow-right"></i>
            <span class="sidebar-text">Logout</span>
        </button>
    </div>

</aside>

<x-logout-modal />