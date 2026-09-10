<div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body text-center p-4">
                <div class="delete-warning-icon">
                    <i class="bi bi-box-arrow-right"></i>
                </div>
                <h5 class="delete-modal-title">Keluar dari Akun?</h5>
                <p class="delete-modal-text">
                    Apakah Anda yakin ingin logout dari sistem ASAP?
                </p>
            </div>

            <div class="modal-footer justify-content-center gap-2">
                <button type="button" class="btn-secondary-custom" data-bs-dismiss="modal">Batal</button>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-danger-custom">
                        <i class="bi bi-box-arrow-right me-1"></i> Ya, Logout
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>