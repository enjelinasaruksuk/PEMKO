@php
    $subUnits = auth()->user()->instansi?->anak()
        ->where('level_instansi', 2)
        ->where('status', 'aktif')
        ->orderBy('nama_instansi')
        ->get() ?? collect();
@endphp

<aside class="unit-sidebar">

    <div class="nav-area">

        <a href="{{ route('instansi.profile') }}"
           class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('instansi.profile') ? 'active' : '' }}">
            <i class="bi bi-person"></i>
            <span class="sidebar-text">Profile</span>
        </a>

        <a href="{{ route('instansi.unit_layanan.index') }}"
           class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('instansi.unit_layanan.*') ? 'active' : '' }}">
            <i class="bi bi-grid"></i>
            <span class="sidebar-text">Nama Unit Layanan</span>
        </a>

        <a href="{{ route('instansi.pelayanan.index') }}"
           class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('instansi.pelayanan.*') ? 'active' : '' }}">
            <i class="bi bi-card-checklist"></i>
            <span class="sidebar-text">Nama Pelayanan</span>
        </a>

        <a href="#skMenu" class="nav-link nav-parent d-flex align-items-center gap-2"
           data-bs-toggle="collapse" role="button"
           aria-expanded="{{ request()->routeIs('instansi.sk.*') || request()->routeIs('instansi.own_sk.*') || request()->routeIs('instansi.pelayanan_sk.*') ? 'true' : 'false' }}"
           aria-controls="skMenu">
            <i class="bi bi-bar-chart"></i>
            <span class="sidebar-text">Pelayanan SK</span>
            <i class="bi bi-plus-lg ms-auto sidebar-text nav-parent-icon"></i>
        </a>

        <div class="collapse submenu {{ request()->routeIs('instansi.sk.*') || request()->routeIs('instansi.own_sk.*') || request()->routeIs('instansi.pelayanan_sk.*') ? 'show' : '' }}" id="skMenu">

            <a href="{{ route('instansi.own_sk.index') }}"
               class="submenu-link {{ request()->routeIs('instansi.own_sk.*') ? 'active' : '' }}">
                <span class="sidebar-text">SK Instansi</span>
            </a>

            @foreach ($subUnits as $subUnit)
                <a href="{{ route('instansi.pelayanan_sk.show', $subUnit) }}"
                   class="submenu-link {{ request()->routeIs('instansi.pelayanan_sk.show') && request()->route('unit')?->id_instansi === $subUnit->id_instansi ? 'active' : '' }}">
                    <span class="sidebar-text">{{ $subUnit->nama_instansi }}</span>
                </a>
            @endforeach

        </div>

        <a href="{{ route('instansi.maklumat.index') }}"
           class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('instansi.maklumat.*') ? 'active' : '' }}">
            <i class="bi bi-megaphone"></i>
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