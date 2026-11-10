@props(['instansi'])

<div class="modal fade" id="modalHapusInstansi{{ $instansi->id_instansi }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4 text-center">
                <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 2.5rem;"></i>
                <h5 class="fw-bold mt-3">Hapus Instansi?</h5>
                <p class="text-muted small">
                    Data <strong>{{ $instansi->nama_instansi }}</strong> akan dihapus permanen.
                    Jika instansi ini sudah dipakai (akun, SK, layanan, atau unit di bawahnya), penghapusan akan ditolak dan sebaiknya diganti status Nonaktif.
                </p>

                <form action="{{ route('admin.instansi.destroy', $instansi) }}" method="POST">
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