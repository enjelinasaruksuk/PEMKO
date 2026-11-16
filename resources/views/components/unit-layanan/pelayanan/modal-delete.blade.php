@props(['baseUrl' => url('unit-layanan/pelayanan')])

<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body text-center p-4">
                <div class="delete-warning-icon">
                    <i class="bi bi-exclamation-triangle"></i>
                </div>
                <h5 class="delete-modal-title">Hapus Pelayanan?</h5>
                <p class="delete-modal-text">
                    Apakah Anda yakin ingin menghapus data pelayanan
                    <strong id="deleteServiceName"></strong>?
                    Data yang sudah dihapus tidak dapat dikembalikan.
                </p>
            </div>

            <div class="modal-footer justify-content-center gap-2">
                <button type="button" class="btn-secondary-custom" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST">
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteModal = document.getElementById('deleteModal');
    if (!deleteModal) return;

    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        if (!button) return;

        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');

        const form = document.getElementById('deleteForm');
        const nameElement = document.getElementById('deleteServiceName');
        if (!form || !nameElement) return;

        form.action = '{{ $baseUrl }}/' + id;
        nameElement.textContent = '"' + name + '"';
    });
});
</script>
@endpush