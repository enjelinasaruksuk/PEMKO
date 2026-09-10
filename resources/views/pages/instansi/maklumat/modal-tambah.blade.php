<div class="modal fade" id="modalTambahMaklumat" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4">
                <h5 class="fw-bold mb-3">Tambah Maklumat</h5>

                <form method="POST" action="{{ route('instansi.maklumat.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Jenis Maklumat</label>
                        <select class="form-select" disabled>
                            <option selected>Mengantikan Nama Penjabat</option>
                        </select>
                        <input type="hidden" name="jenis_maklumat" value="mengganti_pejabat">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Nama Penjabat Baru</label>
                        <input type="text" name="nama_penjabat_baru" class="form-control" placeholder="Masukkan Nama Penjabat" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>