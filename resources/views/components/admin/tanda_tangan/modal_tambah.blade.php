<div class="modal fade" id="modalTambahTtd" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h5 class="fw-bold mb-1">Spesimen Tanda Tangan</h5>
                        <p class="text-muted small mb-0">Unggah ulang untuk NIP yang sama akan mengganti file lama.</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('admin.tanda_tangan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">NIP Pejabat</label>
                        <input type="text" id="ttdNip" name="nip" class="form-control"
                               inputmode="numeric" maxlength="30" placeholder="18 digit NIP"
                               value="{{ old('nip') }}" required>
                        <div class="form-text">Spasi dan tanda baca otomatis dibuang.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">File Tanda Tangan (PNG)</label>
                        <input type="file" id="ttdFile" name="file" class="form-control"
                               accept="image/png" required>
                        <div class="form-text">Maksimal 1 MB. Disarankan background transparan.</div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>