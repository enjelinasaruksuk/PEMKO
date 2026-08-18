<div class="modal fade" id="modalTambahInstansi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="fw-bold mb-0">Tambah Instansi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ Route::has('instansi.store') ? route('instansi.store') : '#' }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Level Akun</label>
                        <select name="level_akun" id="levelAkun" class="form-select">
                            <option value="1">Instansi Level 1</option>
                            <option value="2">Instansi Level 2</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Peran</label>
                        <input type="peran" name="peran" class="form-control" placeholder="Masukan Nama Instansi">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Instansi</label>
                        <select name="instansi_induk" class="form-select" disabled>
                            <option>Pemerintahan Kota Batam</option>
                        </select>
                    </div>

                    {{-- Field ini SELALU muncul kalau Level Akun = 1 atau 2 --}}
                    <div class="mb-3" id="wrapperLevel1">
                        <label class="form-label small fw-semibold">Instansi Level 1</label>
                        <select name="instansi_level_1" class="form-select">
                            <option value="" selected disabled>Pilih Instansi Level 1</option>
                            @foreach ($instansiLevel1 ?? [] as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Field ini CUMA muncul kalau Level Akun = 2 --}}
                    <div class="mb-3 d-none" id="wrapperLevel2">
                        <label class="form-label small fw-semibold">Instansi Level 2</label>
                        <select name="instansi_level_2" class="form-select">
                            <option value="" selected disabled>Pilih Instansi Level 2</option>
                            @foreach ($instansiLevel2 ?? [] as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Email Instansi</label>
                        <input type="email" name="email" class="form-control" placeholder="Masukkan Email Instansi">
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>