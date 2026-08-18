@props(['komponen'])

<div class="modal fade" id="modalEditKomponen{{ $komponen->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="fw-bold mb-0">Edit Komponen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ Route::has('pelayanan.update') ? route('pelayanan.update', $komponen->id) : '#' }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Nama Komponen</label>
                        <input type="text" name="nama_komponen" class="form-control"
                               value="{{ $komponen->nama_komponen }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Kategori</label>
                        <select name="kategori" class="form-select" required>
                            <option value="Penyampaian" {{ $komponen->kategori == 'Penyampaian' ? 'selected' : '' }}>Penyampaian</option>
                            <option value="Pengelolaan" {{ $komponen->kategori == 'Pengelolaan' ? 'selected' : '' }}>Pengelolaan</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>