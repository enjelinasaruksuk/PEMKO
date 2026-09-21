<div class="modal fade" id="tambahPerwaliModal" tabindex="-1" aria-labelledby="tambahPerwaliModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ route('unit_layanan.perwali.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPerwaliModalLabel">Tambah Peraturan Wali Kota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p class="modal-description mb-3">Tambahkan Peraturan Wali Kota.</p>
                    <div>
                        <label class="form-label-custom">Peraturan Wali Kota</label>
                        <textarea name="tentang" class="form-control modal-field" placeholder="Peraturan Walikota (Perwali) Kota Batam Nomor 4 Tahun 2025 tentang Perubahan Atas Peraturan Wali Kota Batam Nomor 47 Tahun 2023 Tentang Penyelenggaraan Pengelolaan Tanah Di Atas Hak Pengelolaan Pemerintah Kota Batam" rows="5" style="resize: vertical; min-height: 120px;" required></textarea>
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