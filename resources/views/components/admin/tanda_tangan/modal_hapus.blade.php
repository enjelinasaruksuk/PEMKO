@props(['ttd'])

<div class="modal fade" id="modalHapusTtd{{ $ttd->nip }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4 text-center">
                <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 2.5rem;"></i>
                <h5 class="fw-bold mt-3">Hapus Spesimen?</h5>
                <p class="text-muted small">
                    Spesimen untuk NIP <strong>{{ $ttd->nip }}</strong> beserta file gambarnya akan dihapus permanen.
                </p>

                <form action="{{ route('admin.tanda_tangan.destroy', $ttd->model) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger px-4">Ya, Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>