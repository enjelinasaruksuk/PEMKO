<div class="modal fade" id="confirmActionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body text-center p-4">
                <div class="delete-warning-icon" id="confirmActionIcon">
                    <i class="bi bi-exclamation-triangle"></i>
                </div>
                <h5 class="delete-modal-title" id="confirmActionTitle">Konfirmasi</h5>
                <p class="delete-modal-text" id="confirmActionText"></p>
            </div>

            <div class="modal-footer justify-content-center gap-2">
                <button type="button" class="btn-secondary-custom" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn-danger-custom" id="confirmActionButton">Ya, Lanjutkan</button>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const el = document.getElementById('confirmActionModal');
    if (!el) return;

    const modal = new bootstrap.Modal(el);
    const icon = document.getElementById('confirmActionIcon');
    const title = document.getElementById('confirmActionTitle');
    const text = document.getElementById('confirmActionText');
    const button = document.getElementById('confirmActionButton');
    let pendingForm = null;

    document.addEventListener('submit', function (event) {
        const form = event.target;
        if (!form.matches || !form.matches('form[data-confirm]')) return;

        event.preventDefault();
        pendingForm = form;

        const isPrimary = form.dataset.confirmType === 'primary';

        title.textContent = form.dataset.confirmTitle || 'Konfirmasi';
        text.textContent = form.dataset.confirmText || 'Apakah Anda yakin?';
        button.textContent = form.dataset.confirmButton || 'Ya, Lanjutkan';

        button.className = isPrimary ? 'btn-primary-custom' : 'btn-danger-custom';
        icon.style.background = isPrimary ? 'rgba(40,120,215,.1)' : '';
        icon.style.color = isPrimary ? '#2878d7' : '';

        modal.show();
    });

    button.addEventListener('click', function () {
        if (!pendingForm) return;
        const form = pendingForm;
        pendingForm = null;
        modal.hide();
        HTMLFormElement.prototype.submit.call(form);
    });
});
</script>
@endpush