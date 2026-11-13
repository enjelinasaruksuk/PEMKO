<div class="unit-navbar">

    {{-- Hamburger --}}
    <button
        type="button"
        class="sidebar-toggle"
        id="sidebarToggle"
    >
        <i class="bi bi-list"></i>
    </button>

    {{-- Nama Unit (mengikuti akun yang login) --}}
    <span class="unit-badge">
        {{ auth()->user()->instansi?->nama_instansi ?? 'Unit Layanan' }}
    </span>

</div>