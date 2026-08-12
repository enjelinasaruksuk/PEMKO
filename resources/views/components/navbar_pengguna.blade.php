<nav class="navbar bg-white border-bottom px-3 py-2 d-flex justify-content-between align-items-center">
    <button class="btn btn-light border" id="sidebarToggle" type="button">
        <i class="bi bi-list fs-4"></i>
    </button>

    <button class="btn btn-primary rounded-pill px-4">
        {{ auth()->user()->instansi->nama_singkat ?? 'Organisasi' }}
    </button>
</nav>