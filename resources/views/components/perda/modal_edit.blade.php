@props(['perda' => null])

<div class="modal fade" id="modalEditPerda{{ $perda->id ?? '' }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h5 class="fw-bold mb-1">Edit Perda</h5>
                        <p class="text-muted small mb-0">Ubah data Perda di bawah ini</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ Route::has('perda.update') ? route('perda.update', $perda->id ?? 0) : '#' }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Nomor Perda</label>
                        <input type="text" name="nomor" class="form-control" value="{{ $perda->nomor ?? '' }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Tentang</label>
                        <textarea name="tentang" rows="3" class="form-control">{{ $perda->tentang ?? '' }}</textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>