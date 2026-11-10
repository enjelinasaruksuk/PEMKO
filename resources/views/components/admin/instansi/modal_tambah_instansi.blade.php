@props(['instansiLevel1' => []])

<div class="modal fade" id="modalTambahInstansi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="fw-bold mb-0">Tambah Instansi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('admin.instansi.store') }}" method="POST" id="formTambahInstansi">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Level Akun</label>
                        <select name="level_instansi" class="form-select js-level-select" required>
                            <option value="1">Instansi Level 1</option>
                            <option value="2">Instansi Level 2</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Instansi</label>
                        <select class="form-select" disabled>
                            <option>Pemerintah Kota Batam</option>
                        </select>
                    </div>

                    {{-- Hanya muncul untuk Level 2 --}}
                    <div class="mb-3 d-none js-induk-wrapper">
                        <label class="form-label small fw-semibold">Instansi Level 1</label>
                        <select name="id_instansi_induk" class="form-select js-induk-select" disabled>
                            <option value="">Pilih Instansi Level 1</option>
                            @foreach ($instansiLevel1 as $item)
                                <option value="{{ $item->id_instansi }}">{{ $item->nama_instansi }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Label & placeholder berubah sesuai level --}}
                    <div class="mb-3">
                        <label class="form-label small fw-semibold js-nama-label">Nama Instansi Level 1</label>
                        <input type="text" name="nama_instansi" class="form-control js-nama-input"
                               placeholder="Contoh: Sekretariat Daerah" maxlength="255" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Email Instansi <span class="text-muted fw-normal">(opsional)</span></label>
                        <input type="email" name="email_instansi" class="form-control" placeholder="Masukkan Email Instansi">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="aktif" selected>Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                        <div class="form-text">Hanya instansi aktif yang muncul di form pengajuan akun.</div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('modalTambahInstansi');
    if (!modal) return;

    const form = modal.querySelector('form');
    const levelSelect = modal.querySelector('.js-level-select');
    const indukWrapper = modal.querySelector('.js-induk-wrapper');
    const indukSelect = modal.querySelector('.js-induk-select');
    const namaLabel = modal.querySelector('.js-nama-label');
    const namaInput = modal.querySelector('.js-nama-input');

    function syncLevel() {
        const isLevel2 = levelSelect.value === '2';

        indukWrapper.classList.toggle('d-none', !isLevel2);
        indukSelect.disabled = !isLevel2;
        indukSelect.required = isLevel2;
        if (!isLevel2) indukSelect.value = '';

        namaLabel.textContent = isLevel2 ? 'Nama Instansi Level 2' : 'Nama Instansi Level 1';
        namaInput.placeholder = isLevel2 ? 'Contoh: Bagian Hukum' : 'Contoh: Sekretariat Daerah';
    }

    levelSelect.addEventListener('change', syncLevel);

    modal.addEventListener('hidden.bs.modal', function () {
        form.reset();
        syncLevel();
    });

    syncLevel();
});
</script>
@endpush