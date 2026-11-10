@props(['instansi', 'instansiLevel1' => []])

@php
    $modalId = 'modalEditInstansi' . $instansi->id_instansi;
    $isLevel2 = (int) $instansi->level_instansi === 2;
    $levelTerkunci = ($instansi->anak_count ?? 0) > 0 || ($instansi->pengguna_count ?? 0) > 0;
@endphp

<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="fw-bold mb-0">Edit Instansi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('admin.instansi.update', $instansi) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Level Akun</label>

                        @if ($levelTerkunci)
                            <input type="hidden" name="level_instansi" value="{{ $instansi->level_instansi }}">
                        @endif

                        <select name="level_instansi" class="form-select js-level-select" @disabled($levelTerkunci) required>
                            <option value="1" @selected(! $isLevel2)>Instansi Level 1</option>
                            <option value="2" @selected($isLevel2)>Instansi Level 2</option>
                        </select>

                        @if ($levelTerkunci)
                            <div class="form-text">Level terkunci karena sudah memiliki unit di bawahnya atau akun.</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Instansi</label>
                        <select class="form-select" disabled>
                            <option>Pemerintah Kota Batam</option>
                        </select>
                    </div>

                    {{-- Dropdown induk: hanya untuk Level 2 --}}
                    <div class="mb-3 js-induk-wrapper {{ $isLevel2 ? '' : 'd-none' }}">
                        <label class="form-label small fw-semibold">Instansi Level 1</label>
                        <select name="id_instansi_induk" class="form-select js-induk-select" @disabled(! $isLevel2)>
                            <option value="">Pilih Instansi Level 1</option>
                            @foreach ($instansiLevel1 as $item)
                                @continue($item->id_instansi == $instansi->id_instansi)
                                <option value="{{ $item->id_instansi }}" @selected($instansi->id_instansi_induk == $item->id_instansi)>
                                    {{ $item->nama_instansi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold js-nama-label">
                            {{ $isLevel2 ? 'Nama Instansi Level 2' : 'Nama Instansi Level 1' }}
                        </label>
                        <input type="text" name="nama_instansi" class="form-control"
                               value="{{ $instansi->nama_instansi }}" maxlength="255" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Email Instansi <span class="text-muted fw-normal">(opsional)</span></label>
                        <input type="email" name="email_instansi" class="form-control"
                               value="{{ $instansi->email_instansi }}" placeholder="Masukkan Email Instansi">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="aktif" @selected($instansi->status === 'aktif')>Aktif</option>
                            <option value="nonaktif" @selected($instansi->status !== 'aktif')>Nonaktif</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('{{ $modalId }}');
    if (!modal) return;

    const form = modal.querySelector('form');
    const levelSelect = modal.querySelector('.js-level-select');
    const indukWrapper = modal.querySelector('.js-induk-wrapper');
    const indukSelect = modal.querySelector('.js-induk-select');
    const namaLabel = modal.querySelector('.js-nama-label');

    function syncLevel() {
        const isLevel2 = levelSelect.value === '2';

        indukWrapper.classList.toggle('d-none', !isLevel2);
        indukSelect.disabled = !isLevel2;
        indukSelect.required = isLevel2;
        if (!isLevel2) indukSelect.value = '';

        namaLabel.textContent = isLevel2 ? 'Nama Instansi Level 2' : 'Nama Instansi Level 1';
    }

    levelSelect.addEventListener('change', syncLevel);

    // Batal edit: kembalikan ke nilai awal dari database
    modal.addEventListener('hidden.bs.modal', function () {
        form.reset();
        syncLevel();
    });

    syncLevel();
});
</script>
@endpush