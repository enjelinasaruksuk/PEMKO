<div class="modal fade" id="tambahPerdaModal" tabindex="-1" aria-labelledby="tambahPerdaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form method="POST" action="#">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPerdaModalLabel">Tambah Peraturan Daerah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p class="modal-description mb-3">Tambahkan Peraturan Daerah.</p>
                    <div>
                        <label class="form-label-custom">Peraturan Daerah</label>
                        <textarea name="perda" class="form-control modal-field" placeholder="Masukkan Peraturan Daerah" rows="5" style="resize: vertical; min-height: 120px;"></textarea>
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