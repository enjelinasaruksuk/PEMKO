
@props(['instansi'])

<div class="modal fade" id="modalEditInstansi{{ $instansi->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="fw-bold mb-0">Edit Instansi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ Route::has('admin.instansi.update') ? route('admin.instansi.update', $instansi->id) : '#' }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Level Akun</label>
                        <select name="level_akun" class="form-select" id="editLevelAkun{{ $instansi->id }}">
                            <option value="1">Instansi Level 1</option>
                            <option value="2">Instansi Level 2</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Peran</label>
                        <input type="text" name="peran" class="form-control" placeholder="Masukan Nama Instansi">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Instansi</label>
                        <select name="instansi_induk" class="form-select" disabled>
                            <option>Pemerintahan Kota Batam</option>
                        </select>
                    </div>

                    {{-- Instansi Level 1 SELALU muncul --}}
                    <div class="mb-3" id="wrapperEditLevel1{{ $instansi->id }}">
                        <label class="form-label small fw-semibold">Instansi Level 1</label>
                        <select name="instansi_level_1" class="form-select">
                            <option value="" selected disabled>Pilih Instansi Level 1</option>

                            @foreach ($instansiLevel1 ?? [] as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Instansi Level 2 hanya muncul kalau Level Akun = 2 --}}
                    <div class="mb-3 d-none" id="wrapperEditLevel2{{ $instansi->id }}">
                        <label class="form-label small fw-semibold">Instansi Level 2</label>
                        <select name="instansi_level_2" class="form-select">
                            <option value="" selected disabled>Pilih Instansi Level 2</option>

                            @foreach ($instansiLevel2 ?? [] as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Email Instansi</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ $instansi->email }}"
                               placeholder="Masukkan Email Instansi">
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2">
                        Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const levelAkun = document.getElementById('editLevelAkun{{ $instansi->id }}');
    const wrapperLevel1 = document.getElementById('wrapperEditLevel1{{ $instansi->id }}');
    const wrapperLevel2 = document.getElementById('wrapperEditLevel2{{ $instansi->id }}');

    levelAkun.addEventListener('change', function () {

        if (this.value == '1') {
            // Level 1 → hanya Level 1
            wrapperLevel1.classList.remove('d-none');
            wrapperLevel2.classList.add('d-none');

        } else if (this.value == '2') {
            // Level 2 → Level 1 + Level 2
            wrapperLevel1.classList.remove('d-none');
            wrapperLevel2.classList.remove('d-none');
        }

    });

});
</script>

