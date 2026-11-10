@props(['pengguna'])

<div class="modal fade" id="modalDetailPengguna{{ $pengguna->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="fw-bold mb-0">Detail Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="mb-3"><div class="text-muted small">Nama</div><div class="fw-semibold">{{ $pengguna->nama }}</div></div>
                <div class="mb-3"><div class="text-muted small">Email</div><div class="fw-semibold">{{ $pengguna->email ?? '-' }}</div></div>
                <div class="mb-3">
                    <div class="text-muted small">Instansi</div>
                    <div class="fw-semibold">{{ $pengguna->instansi_nama }}</div>
                    <div class="text-muted small">{{ $pengguna->instansi_singkatan }}</div>
                </div>
                <div class="mb-3"><div class="text-muted small">Peran</div><div class="fw-semibold">{{ $pengguna->peran }}</div></div>
                <div class="mb-3"><div class="text-muted small">Status</div><div class="fw-semibold">{{ $pengguna->status }}</div></div>
                <div class="mb-0"><div class="text-muted small">Masuk Terakhir</div><div class="fw-semibold">{{ $pengguna->masuk_terakhir }}</div></div>
            </div>
        </div>
    </div>
</div>