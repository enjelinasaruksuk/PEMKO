@props(['skList'])

@foreach ($skList as $sk)
<div class="modal fade" id="konfirmasiModal{{ $sk->id }}" tabindex="-1"
     aria-labelledby="konfirmasiModalTitle{{ $sk->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title" id="konfirmasiModalTitle{{ $sk->id }}">Catatan Konfirmasi</h5>
                    <p class="modal-description mb-0 mt-1">SK {{ $sk->no_sk }} menunggu persetujuan instansi.</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form method="POST" action="{{ route('unit_layanan.sk.konfirmasi', $sk) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <label for="catatanKonfirmasi{{ $sk->id }}" class="form-label-custom">Catatan</label>
                    <textarea id="catatanKonfirmasi{{ $sk->id }}" name="catatan_konfirmasi"
                              class="form-control" rows="4" maxlength="5000">{{ old('catatan_konfirmasi', $sk->catatan_konfirmasi) }}</textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-primary-custom">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
