<div class="modal fade" id="modalTambahKomponen" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="fw-bold mb-0">Tambah Komponen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ Route::has('pelayanan.store') ? route('pelayanan.store') : '#' }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Nama Komponen</label>
                        <input type="text" name="nama_komponen" class="form-control"
                               placeholder="Masukan Nama Komponen" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Kategori</label>
                        <select name="kategori" class="form-select" required>
                            <option value="" selected disabled>Penyampaian Pelayanan</option>
                            <option value="Penyampaian">Penyampaian</option>
                            <option value="Pengelolaan">Pengelolaan</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>