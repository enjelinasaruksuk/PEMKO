<aside class="unit-sidebar">

    {{-- MENU --}}
    <div class="nav-area">

        {{-- ==========================================================
             PROFIL
        =========================================================== --}}
        <a
            href="{{ route('unit_layanan.profile') }}"
            class="nav-link d-flex align-items-center gap-2"
        >
            <i class="bi bi-building"></i>

            <span class="sidebar-text">
                Profil
            </span>
        </a>


        {{-- ==========================================================
             PELAYANAN
        =========================================================== --}}
        <a
            href="{{ route('unit_layanan.pelayanan.index') }}"
            class="nav-link d-flex align-items-center gap-2"
        >
            <i class="bi bi-grid"></i>

            <span class="sidebar-text">
                Pelayanan
            </span>
        </a>


        {{-- ==========================================================
             PENGESAHAN SK
        =========================================================== --}}
        <a
            href="#skMenu"
            class="nav-link d-flex align-items-center gap-2"
            data-bs-toggle="collapse"
            role="button"

            {{-- Tetap terbuka jika sedang berada di halaman SK --}}
            aria-expanded="{{ request()->routeIs('unit_layanan.sk.*') ? 'true' : 'false' }}"

            aria-controls="skMenu"
        >

            <i class="bi bi-file-earmark-text"></i>

            <span class="sidebar-text">
                Pengesahan SK
            </span>

            <i
                class="bi bi-chevron-down ms-auto sidebar-text"
                style="font-size: 11px;"
            ></i>

        </a>


        {{-- ==========================================================
             DROPDOWN PENGESAHAN SK
        =========================================================== --}}
        <div
            class="collapse {{ request()->routeIs('unit_layanan.sk.*') ? 'show' : '' }}"
            id="skMenu"
        >

            {{-- BAGIAN ORGANISASI --}}
            <a
                href="{{ route('unit_layanan.sk.index') }}"
                class="nav-link d-flex align-items-center gap-2 ps-5
                    {{ request()->routeIs('unit_layanan.sk.index') ? 'active' : '' }}"
                style="font-size: 13px;"
            >

                <i class="bi bi-dot"></i>

                <span class="sidebar-text">
                    Bagian Organisasi
                </span>

            </a>

        </div>

    </div>


    {{-- ==========================================================
         LOGOUT
    =========================================================== --}}
    <div class="logout-area">

        <a
            href="#"
            class="nav-link d-flex align-items-center gap-2"
        >

            <i class="bi bi-box-arrow-right"></i>

            <span class="sidebar-text">
                Logout
            </span>

        </a>

    </div>

</aside>