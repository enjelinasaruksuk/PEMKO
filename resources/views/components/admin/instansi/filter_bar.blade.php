@props(['modalTarget' => '#modalTambah'])

<div class="bg-white rounded shadow-sm p-3 mb-3 d-flex gap-3 flex-wrap justify-content-between align-items-center">
    <div class="d-flex gap-3 flex-wrap">
        <select class="form-select w-auto">
            <option>Unit Layanan</option>
        </select>
        <select class="form-select w-auto">
            <option>Akun Aktif</option>
        </select>
        <div class="input-group w-auto">
            <input type="text" class="form-control" placeholder="Cari...">
            <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
        </div>
    </div>

    <button type="button" class="btn btn-primary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="{{ $modalTarget }}">
        <i class="bi bi-plus-circle"></i> Tambah
    </button>
</div>