@props(['profile' => null])

<div class="modal fade" id="createProfileModal" tabindex="-1" aria-labelledby="createProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <div>
                    <h5 class="modal-title" id="createProfileModalLabel">
                        {{ $profile ? 'Ubah Data Profil' : 'Tambah Data Profil' }}
                    </h5>
                    <p class="modal-description mb-0">Isilah form berikut untuk mengisi data profil unit layanan.</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('unit_layanan.profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="row g-4">

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label-custom">Nama Unit Layanan</label>
                                <input type="text" name="nama_unit" class="form-control" value="{{ old('nama_unit', $profile->nama_unit ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label-custom">Nama Kepala Dinas/UUP</label>
                                <input type="text" name="nama_kepala" class="form-control" value="{{ old('nama_kepala', $profile->nama_kepala ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label-custom">Jabatan</label>
                                <select name="jabatan" class="form-select">
                                    <option value="">Pilih Jabatan</option>
                                    <option value="Non PLT" {{ old('jabatan', $profile->jabatan ?? '') == 'Non PLT' ? 'selected' : '' }}>Non PLT</option>
                                    <option value="PLT" {{ old('jabatan', $profile->jabatan ?? '') == 'PLT' ? 'selected' : '' }}>PLT</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label-custom">Laman (Website)</label>
                                <input type="text" name="website" class="form-control" value="{{ old('website', $profile->website ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label-custom">Alamat</label>
                                <textarea name="alamat" class="form-control" rows="4">{{ old('alamat', $profile->alamat ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label-custom">NIP</label>
                                <input type="text" name="nip" class="form-control" value="{{ old('nip', $profile->nip ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label-custom">Pangkat</label>
                                <input type="text" name="pangkat" class="form-control" value="{{ old('pangkat', $profile->pangkat ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label-custom">Pos-el/Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $profile->email ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label-custom">Misi</label>
                                <textarea name="misi" class="form-control" rows="4">{{ old('misi', $profile->misi ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label-custom">Telepon</label>
                                <input type="text" name="telepon" class="form-control" value="{{ old('telepon', $profile->telepon ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label-custom">Faksimile</label>
                                <input type="text" name="faksimile" class="form-control" value="{{ old('faksimile', $profile->faksimile ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label-custom">Motto</label>
                                <textarea name="motto" class="form-control" rows="2">{{ old('motto', $profile->motto ?? '') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label-custom">Visi</label>
                                <textarea name="visi" class="form-control" rows="4">{{ old('visi', $profile->visi ?? '') }}</textarea>
                            </div>
                        </div>

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