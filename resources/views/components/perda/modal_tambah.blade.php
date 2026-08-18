<div class="modal fade" id="modalTambahPerda" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h5 class="fw-bold mb-1">Tambah Perda</h5>
                        <p class="text-muted small mb-0">Isilah form dibawah ini untuk menambah data Perda</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ Route::has('perda.store') ? route('perda.store') : '#' }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Nomor Perda</label>
                        <input type="text" name="nomor" class="form-control" placeholder="Nomor 6 Tahun 2023">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Tentang</label>
                        <textarea name="tentang" rows="3" class="form-control" placeholder="Peraturan Daerah Kota Batam Nomor 6 Tahun 2023 tentang..."></textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>