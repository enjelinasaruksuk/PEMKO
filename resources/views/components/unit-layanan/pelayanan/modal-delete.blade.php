@props(['baseUrl' => url('unit-layanan/pelayanan')])

<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Hapus Data Pelayanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p class="modal-description mb-0">
                    Apakah Anda yakin ingin menghapus data pelayanan
                    <strong id="deleteServiceName"></strong>?
                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
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