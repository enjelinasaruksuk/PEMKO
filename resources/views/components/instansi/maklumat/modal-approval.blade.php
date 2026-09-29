@props(['maklumat'])

<div class="modal fade" id="modalApprovalMaklumat{{ $maklumat->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="fw-bold mb-0">Konfirmasi Maklumat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('instansi.maklumat.approve', $maklumat->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <select name="keputusan" class="form-select" required>
                            <option value="disetujui">Setuju</option>
                            <option value="ditolak">Tolak</option>
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