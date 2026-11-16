@php
    $pesanSukses = session('success_modal') ?? session('success');
@endphp

@if ($pesanSukses)
<div class="modal fade" id="notifSuccessModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-4">
                <div class="admin-modal-icon admin-modal-icon-success">
                    <i class="bi bi-check-lg"></i>
                </div>
                <h5 class="admin-modal-title">Berhasil!</h5>
                <p class="admin-modal-text">{{ $pesanSukses }}</p>
                <button type="button" class="btn-primary-custom" data-bs-dismiss="modal">Oke, Mengerti</button>
            </div>
        </div>
    </div>
</div>
@endif

@if ($errors->any())
<div class="modal fade" id="notifErrorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-4">
                <div class="admin-modal-icon admin-modal-icon-danger">
                    <i class="bi bi-exclamation-lg"></i>
                </div>
                <h5 class="admin-modal-title">Terjadi Kesalahan</h5>
                <ul class="admin-modal-error-list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-danger-custom" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endif

@if ($pesanSukses || $errors->any())
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    ['notifSuccessModal', 'notifErrorModal'].forEach(function (id) {
        const el = document.getElementById(id);
        if (el) new bootstrap.Modal(el).show();
    });
});
</script>
@endpush
@endif