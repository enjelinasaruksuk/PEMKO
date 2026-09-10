<div class="modal fade" id="modalTambahPerwali" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ Route::has('instansi.perwali.store') ? route('instansi.perwali.store') : '#' }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Peraturan Wali Kota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p class="modal-description mb-3">Tambahkan Peraturan Wali Kota.</p>
                    <div>
                        <label class="form-label-custom">Peraturan Wali Kota</label>
                        <textarea name="tentang" class="form-control" rows="5" placeholder="Masukkan Peraturan Wali Kota" style="resize: vertical; min-height: 120px;"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-secondary-custom" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-primary-custom">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>