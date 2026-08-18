@props(['modalTarget' => '#modalTambah'])

<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div class="d-flex gap-2 flex-wrap">
        <select class="form-select w-auto">
            <option>Jumlah Unit</option>
        </select>
        <select class="form-select w-auto">
            <option>Akun Aktif</option>
        </select>
    </div>
    <div class="d-flex gap-2">
        <div class="input-group w-auto">
            <input type="text" class="form-control" placeholder="Search projects">
            <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
        </div>
        <button type="button" class="btn btn-primary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="{{ $modalTarget }}">
            <i class="bi bi-plus-circle"></i> Tambah
        </button>
    </div>
</div>