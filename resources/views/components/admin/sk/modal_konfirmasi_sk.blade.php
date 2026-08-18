@props(['sk'])

<div class="modal fade" id="modalKonfirmasiSk{{ $sk->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="fw-bold mb-0">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ Route::has('sk.confirm') ? route('sk.confirm', $sk->id) : '#' }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <select name="konfirmasi_status" class="form-select">
                            <option value="disetujui" {{ $sk->konfirmasi_status == 'disetujui' ? 'selected' : '' }}>
                                Sudah Sesuai
                            </option>
                            <option value="belum" {{ $sk->konfirmasi_status != 'disetujui' ? 'selected' : '' }}>
                                Belum Sesuai
                            </option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <textarea name="catatan" class="form-control" rows="3"
                                  placeholder="Catatan">{{ $sk->catatan ?? '' }}</textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>