@props(['komponen'])

<div class="modal fade" id="modalHapusKomponen{{ $komponen->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4 text-center">
                <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 2.5rem;"></i>
                <h5 class="fw-bold mt-3">Hapus Komponen?</h5>
                <p class="text-muted mb-4">
                    Apakah kamu yakin ingin menghapus komponen
                    <strong>{{ $komponen->nama_komponen }}</strong>? Tindakan ini tidak bisa dibatalkan.
                </p>

                <div class="d-flex gap-2 justify-content-center">
                    <button type="button" class="btn btn-light border px-4" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ Route::has('pelayanan.destroy') ? route('pelayanan.destroy', $komponen->id) : '#' }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger px-4">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>