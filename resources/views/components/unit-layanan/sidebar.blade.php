<aside class="unit-sidebar">

    <div class="nav-area">

        {{-- =====================================================
             PROFIL
        ====================================================== --}}
        <a href="{{ route('unit_layanan.profile') }}"
           class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('unit_layanan.profile') ? 'active' : '' }}">
            <i class="bi bi-building"></i>
            <span class="sidebar-text">Profil</span>
        </a>

        {{-- =====================================================
             PELAYANAN
        ====================================================== --}}
        <a href="{{ route('unit_layanan.pelayanan.index') }}"
           class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('unit_layanan.pelayanan.*') ? 'active' : '' }}">
            <i class="bi bi-grid"></i>
            <span class="sidebar-text">Pelayanan</span>
        </a>

        {{-- =====================================================
             PENGESAHAN SK (dropdown)
        ====================================================== --}}
        <a href="#skMenu" class="nav-link nav-parent d-flex align-items-center gap-2"
           data-bs-toggle="collapse" role="button"
           aria-expanded="{{ request()->routeIs('unit_layanan.sk.*') ? 'true' : 'false' }}"
           aria-controls="skMenu">
            <i class="bi bi-file-earmark-text"></i>
            <span class="sidebar-text">Pengesahan SK</span>
            <i class="bi bi-plus-lg ms-auto sidebar-text nav-parent-icon"></i>
        </a>

        <div class="collapse submenu {{ request()->routeIs('unit_layanan.sk.*') ? 'show' : '' }}" id="skMenu">
            <a href="{{ route('unit_layanan.sk.index') }}"
               class="submenu-link {{ request()->routeIs('unit_layanan.sk.index') ? 'active' : '' }}">
                <span class="sidebar-text">Bagian Organisasi</span>
            </a>
        </div>

        {{-- =====================================================
             MAKLUMAT
        ====================================================== --}}
        <a href="{{ route('unit_layanan.maklumat.index') }}"
           class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('unit_layanan.maklumat.*') ? 'active' : '' }}">
            <i class="bi bi-megaphone"></i>
            <span class="sidebar-text">Maklumat</span>
        </a>

    </div>

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