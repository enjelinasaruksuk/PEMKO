<div class="modal fade" id="modalTambahPerda" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ Route::has('instansi.perda.store') ? route('instansi.perda.store') : '#' }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Peraturan Daerah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p class="modal-description mb-3">Tambahkan Peraturan Daerah.</p>
                    <div>
                        <label class="form-label-custom">Peraturan Daerah</label>
                        <textarea name="tentang" class="form-control modal-field" rows="5" placeholder="Peraturan Daerah (Perda) Kota Batam Nomor 1 Tahun 2026 tentang Penyelenggaraan Administrasi Kependudukan" style="resize: vertical; min-height: 120px;" required></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-primary-custom">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>