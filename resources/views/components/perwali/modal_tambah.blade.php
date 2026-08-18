<div class="modal fade" id="modalTambahPerwali" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h5 class="fw-bold mb-1">Tambah Perwali</h5>
                        <p class="text-muted small mb-0">Isilah form dibawah ini untuk menambah data Perwali</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ Route::has('perwali.store') ? route('perwali.store') : '#' }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Nomor Perwali</label>
                        <input type="text" name="nomor" class="form-control" placeholder="Nomor 87 Tahun 2022">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Tentang</label>
                        <textarea name="tentang" rows="3" class="form-control" placeholder="Peraturan Wali Kota Batam Nomor 87 Tahun 2022 tentang..."></textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>