<header class="unit-navbar">

    {{-- Hamburger --}}
    <button
        type="button"
        class="sidebar-toggle"
        id="sidebarToggle"
    >
        <i class="bi bi-list"></i>
    </button>

    {{-- Badge --}}
    <span class="unit-badge">
        {{ auth()->user()->name ?? 'Admin' }}
    </span>

</header>