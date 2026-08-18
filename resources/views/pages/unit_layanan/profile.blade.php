@extends('layouts.unit_layanan')
@section('title', 'Profile Unit Layanan')

@section('content')
    <x-unit_layanan.page-header
        :title="'Profil Unit Layanan - ' . ($profile->nama_unit ?? 'Bagian Organisasi')"
        subtitle="Form profil unit layanan anda">
        {{-- Tombol Tambah Perda dan Perwali hanya muncul kalau profil sudah punya data --}}
        @if($profile)
            <x-slot:action>
                <button type="button" class="btn btn-sm btn-primary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#modalPerdaPerwali">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Perda dan Perwali
                </button>
            </x-slot:action>
        @endif
    </x-unit_layanan.page-header>

    {{-- ============ STATE: BELUM ADA DATA ============ --}}
    @unless($profile)
        <div class="card border-0 shadow-sm" id="profileEmptyState">
            <div class="card-body" style="min-height: 160px;"></div>
        </div>
        <div class="mt-3" id="profileEmptyAction">
            <button type="button" class="btn btn-sm btn-primary rounded-pill px-3" id="btnTambahDataProfile">
                <i class="bi bi-plus-circle me-1"></i> Tambah Data
            </button>
        </div>

        @push('scripts')
            <script>
                document.getElementById('btnTambahDataProfile')?.addEventListener('click', function () {
                    document.getElementById('profileEmptyState')?.classList.add('d-none');
                    document.getElementById('profileEmptyAction')?.classList.add('d-none');
                    document.getElementById('profileFormCard')?.classList.remove('d-none');
                });
            </script>
        @endpush
    @endunless

    {{-- ============ STATE: FORM PROFIL ============ --}}
    {{-- Kalau $profile ada isinya -> langsung tampil. Kalau belum -> tersembunyi, dimunculkan lewat tombol "Tambah Data" di atas --}}
    <div class="card border-0 shadow-sm {{ $profile ? '' : 'd-none' }}" id="profileFormCard">
        <div class="card-body p-4">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    {{-- Kolom 1 --}}
                    <div class="col-md-4">
                        <x-unit_layanan.form-field label="Nama Unit Layanan:" name="nama_unit" :value="$profile->nama_unit ?? ''" />
                        <x-unit_layanan.form-field label="Nama Kepala Dinas/UUP:" name="nama_kepala" :value="$profile->nama_kepala ?? ''" />
                        <x-unit_layanan.form-field label="" name="status_kepala" :value="$profile->status_kepala ?? 'non_plt'"
                            :options="['non_plt' => 'Non PLT', 'plt' => 'PLT']" />
                        <x-unit_layanan.form-field label="Laman (Website):" name="website" :value="$profile->website ?? ''" />

                        <div class="mb-2">
                            <label class="form-label small fw-semibold mb-1">Perwali:</label>
                            <ol class="small text-muted ps-3 mb-0">
                                @forelse (($profile->perwalis ?? []) as $perwali)
                                    <li>{{ $perwali->isi ?? $perwali['isi'] ?? '' }}</li>
                                @empty
                                    <li class="text-muted">Belum ada data</li>
                                @endforelse
                            </ol>
                        </div>
                    </div>

                    {{-- Kolom 2 --}}
                    <div class="col-md-4">
                        <x-unit_layanan.form-field label="Alamat:" name="alamat" :value="$profile->alamat ?? ''" />
                        <x-unit_layanan.form-field label="NIP:" name="nip" :value="$profile->nip ?? ''" />
                        <x-unit_layanan.form-field label="Pangkat:" name="pangkat" :value="$profile->pangkat ?? ''" />
                        <x-unit_layanan.form-field label="Misi:" name="misi" :value="$profile->misi ?? ''" />
                        <x-unit_layanan.form-field label="Pos-el/Email:" name="email" type="email" :value="$profile->email ?? ''" />

                        <div class="mb-2">
                            <label class="form-label small fw-semibold mb-1">Perda:</label>
                            <ol class="small text-muted ps-3 mb-0">
                                @forelse (($profile->perdas ?? []) as $perda)
                                    <li>{{ $perda->isi ?? $perda['isi'] ?? '' }}</li>
                                @empty
                                    <li class="text-muted">Belum ada data</li>
                                @endforelse
                            </ol>
                        </div>
                    </div>

                    {{-- Kolom 3 --}}
                    <div class="col-md-4">
                        <x-unit_layanan.form-field label="Telepon:" name="telepon" :value="$profile->telepon ?? ''" />
                        <x-unit_layanan.form-field label="Faksimile:" name="faksimile" :value="$profile->faksimile ?? ''" />
                        <x-unit_layanan.form-field label="Motto:" name="motto" :value="$profile->motto ?? ''" />
                        <x-unit_layanan.form-field label="Visi:" name="visi" :value="$profile->visi ?? ''" />
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-sm btn-primary rounded-pill px-4">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal besar: manajemen Perda & Perwali (tambah/edit di dalamnya pakai modal juga, lihat komponen simple-list-manager) --}}
    @if($profile)
        <div class="modal fade" id="modalPerdaPerwali" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title fw-bold text-primary mb-0">Perda &amp; Perwali</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <x-unit_layanan.simple-list-manager
                            id="perda"
                            :title="'Perda - ' . ($profile->nama_unit ?? 'Bagian Organisasi')"
                            subtitle="Silahkan isi form dibawah ini untuk merubah profil unit layanan anda"
                            :items="$profile->perdas ?? []"
                            add-label="Tambah Perda"
                            placeholder="Peraturan Daerah Kota Batam Nomor ..."
                            store-route="perda.store"
                            update-route="perda.update"
                            destroy-route="perda.destroy" />

                        <x-unit_layanan.simple-list-manager
                            id="perwali"
                            :title="'Perwali - ' . ($profile->nama_unit ?? 'Bagian Organisasi')"
                            subtitle="Silahkan isi form dibawah ini untuk merubah profil unit layanan anda"
                            :items="$profile->perwalis ?? []"
                            add-label="Tambah Perwali"
                            placeholder="Peraturan Wali Kota Batam Nomor ..."
                            store-route="perwali.store"
                            update-route="perwali.update"
                            destroy-route="perwali.destroy" />
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection