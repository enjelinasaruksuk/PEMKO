@props(['perda'])

<div class="modal fade" id="modalHapusPerda{{ $perda->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-4">
                <div class="delete-warning-icon">
                    <i class="bi bi-exclamation-triangle"></i>
                </div>
                <h5 class="delete-modal-title">Hapus Perda?</h5>
                <p class="delete-modal-text">
                    Apakah Anda yakin ingin menghapus data Perda ini? Data yang sudah dihapus tidak dapat dikembalikan.
                </p>
            </div>

            <div class="modal-footer justify-content-center gap-2">
                <button type="button" class="btn-secondary-custom" data-bs-dismiss="modal">Batal</button>
                <form method="POST" action="{{ Route::has('instansi.perda.destroy') ? route('instansi.perda.destroy', $perda->id) : '#' }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger-custom">
                        <i class="bi bi-trash me-1"></i> Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>