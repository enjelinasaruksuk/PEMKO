@props(['skList'])

<div class="modal fade" id="skModal" tabindex="-1" aria-labelledby="skModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <div>
                    <h5 class="modal-title" id="skModalTitle">Tambah SK</h5>
                    <p class="modal-description mb-0 mt-1" id="skModalDescription">
                        Isilah form di bawah ini untuk menambah data SK baru.
                    </p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="skForm" method="POST" action="{{ route('instansi.sk.store') }}">
                @csrf
                <input type="hidden" id="skMethod" name="_method" value="POST">

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="noSK" class="form-label-custom">No SK</label>
                        <input type="text" id="noSK" name="no_sk" class="form-control" placeholder="000/2026" required>
                    </div>

                    <div class="mb-3">
                        <label for="tanggalSK" class="form-label-custom">Tanggal</label>
                        <input type="date" id="tanggalSK" name="tanggal_sk" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="jenisSK" class="form-label-custom">Jenis SK</label>
                        <select id="jenisSK" name="jenis_sk" class="form-select" required>
                            <option value="">Pilih Jenis SK</option>
                            <option value="SK Baru">SK Baru</option>
                            <option value="Menggantikan SK Sebelumnya">Menggantikan SK Sebelumnya</option>
                        </select>
                    </div>

                    <div class="mb-3" id="noSkSebelumnyaWrapper" style="display: none;">
                        <label for="noSkSebelumnya" class="form-label-custom">No SK Sebelumnya</label>
                        <select id="noSkSebelumnya" name="no_sk_sebelumnya" class="form-select">
                            <option value="">Pilih No SK Sebelumnya</option>
                            @foreach ($skList as $oldSk)
                                @if (!empty($oldSk->no_sk))
                                    <option value="{{ $oldSk->no_sk }}">{{ $oldSk->no_sk }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-primary-custom">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>