@props(['pengguna', 'instansiLevel1' => [], 'instansiLevel2' => []])

@php
    $modalId = 'modalEditPengguna' . $pengguna->id;
    $isLevel2 = (int) $pengguna->level_akun === 2;
@endphp

<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="fw-bold mb-0">Edit Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('admin.pengguna.update', $pengguna->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Level Akun</label>
                        <select name="level_akun" class="form-select js-level" required>
                            <option value="1" @selected(! $isLevel2)>Instansi Level 1</option>
                            <option value="2" @selected($isLevel2)>Instansi Level 2</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Instansi</label>
                        <select class="form-select" disabled>
                            <option>Pemerintah Kota Batam</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Instansi Level 1</label>
                        <select name="instansi_level_1" class="form-select js-l1" required>
                            <option value="">Pilih Instansi Level 1</option>
                            @foreach ($instansiLevel1 as $item)
                                <option value="{{ $item->id_instansi }}" @selected($pengguna->id_instansi_level_1 == $item->id_instansi)>
                                    {{ $item->nama_instansi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 js-l2-wrapper {{ $isLevel2 ? '' : 'd-none' }}">
                        <label class="form-label small fw-semibold">Instansi Level 2</label>
                        <select name="instansi_level_2" class="form-select js-l2" @disabled(! $isLevel2)>
                            <option value="">Pilih Instansi Level 2</option>
                            @foreach ($instansiLevel2 as $item)
                                <option value="{{ $item->id_instansi }}"
                                        data-induk="{{ $item->id_instansi_induk }}"
                                        @selected($pengguna->id_instansi_level_2 == $item->id_instansi)>
                                    {{ $item->nama_instansi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $pengguna->email }}" required>
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

    const level = modal.querySelector('.js-level');
    const l1 = modal.querySelector('.js-l1');
    const l2Wrapper = modal.querySelector('.js-l2-wrapper');
    const l2 = modal.querySelector('.js-l2');

    function sync() {
        const isLevel2 = level.value === '2';
        l2Wrapper.classList.toggle('d-none', !isLevel2);
        l2.disabled = !isLevel2;
        l2.required = isLevel2;

        l2.querySelectorAll('option[data-induk]').forEach(function (opt) {
            const cocok = opt.dataset.induk === l1.value;
            opt.hidden = !cocok;
            opt.disabled = !cocok;
            if (!cocok && opt.selected) l2.value = '';
        });
    }

    level.addEventListener('change', sync);
    l1.addEventListener('change', function () { l2.value = ''; sync(); });
    modal.addEventListener('hidden.bs.modal', function () {
        modal.querySelector('form').reset();
        sync();
    });
    sync();
});
</script>
@endpush