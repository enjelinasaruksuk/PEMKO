@props(['instansi'])

<div class="modal fade" id="modalEditInstansi{{ $instansi->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="fw-bold mb-0">Edit Instansi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ Route::has('instansi.update') ? route('instansi.update', $instansi->id) : '#' }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Nama Instansi</label>
                        <input type="text" name="nama" class="form-control" value="{{ $instansi->nama }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Email Instansi</label>
                        <input type="email" name="email" class="form-control" value="{{ $instansi->email }}">
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>