<div class="unit-navbar">
    <button type="button" class="sidebar-toggle" id="sidebarToggle">
        <i class="bi bi-list"></i>
    </button>

    <span class="unit-badge">
        {{ auth()->user()->instansi?->nama_instansi ?? 'Instansi' }}
    </span>
</div>