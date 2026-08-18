@props(['profile' => null])

<div class="modal fade" id="modalTambahDataProfile" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h5 class="fw-bold text-primary mb-1">Profil Unit Layanan</h5>
                        <p class="text-muted small mb-0">Form profil unit layanan anda</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Nama Unit Layanan:</label>
                                <input type="text" name="nama_unit" class="form-control" value="{{ old('nama_unit', $profile->nama_unit ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Nama Kepala Dinas/UUP:</label>
                                <input type="text" name="nama_kepala" class="form-control" value="{{ old('nama_kepala', $profile->nama_kepala ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <select name="status_kepala" class="form-select">
                                    <option value="non_plt" selected>Non PLT</option>
                                    <option value="plt">PLT</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Laman (Website):</label>
                                <input type="text" name="website" class="form-control" value="{{ old('website', $profile->website ?? '') }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Alamat:</label>
                                <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $profile->alamat ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">NIP:</label>
                                <input type="text" name="nip" class="form-control" value="{{ old('nip', $profile->nip ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Pangkat:</label>
                                <input type="text" name="pangkat" class="form-control" value="{{ old('pangkat', $profile->pangkat ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Misi:</label>
                                <input type="text" name="misi" class="form-control" value="{{ old('misi', $profile->misi ?? '') }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Telepon:</label>
                                <input type="text" name="telepon" class="form-control" value="{{ old('telepon', $profile->telepon ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Faksimile:</label>
                                <input type="text" name="faksimile" class="form-control" value="{{ old('faksimile', $profile->faksimile ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Motto:</label>
                                <input type="text" name="motto" class="form-control" value="{{ old('motto', $profile->motto ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Visi:</label>
                                <input type="text" name="visi" class="form-control" value="{{ old('visi', $profile->visi ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Pos-el/Email:</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $profile->email ?? '') }}">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>