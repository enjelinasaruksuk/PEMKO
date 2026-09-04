@props(['pengajuan'])

<div class="modal fade" id="modalPengajuan{{ $pengajuan->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="fw-bold mb-0">Pengajuan Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ Route::has('admin.instansi_pengajuan.update') ? route('admin.instansi_pengajuan.update', $pengajuan->id) : '#' }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <select name="keputusan" class="form-select" required>
                            <option value="disetujui" {{ $pengajuan->status === 'disetujui' ? 'selected' : '' }}>Setuju</option>
                            <option value="ditolak" {{ $pengajuan->status === 'ditolak' ? 'selected' : '' }}>Tolak</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>