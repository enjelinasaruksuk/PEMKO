@props(['skList'])

@foreach ($skList as $sk)
<div class="modal fade" id="konfirmasiModal{{ $sk->id }}" tabindex="-1"
     aria-labelledby="konfirmasiModalTitle{{ $sk->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title" id="konfirmasiModalTitle{{ $sk->id }}">Riwayat Percakapan SK</h5>
                    <p class="modal-description mb-0 mt-1">Semua pesan Unit Pelayanan dan Admin untuk SK {{ $sk->no_sk }}.</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form method="POST" action="{{ route('unit_layanan.sk.konfirmasi', $sk) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="d-flex flex-column gap-2 mb-3" style="max-height: 50vh; overflow-y: auto;">
                        @forelse ($sk->messages as $message)
                        <div class="border rounded-3 p-3 {{ $message->sender_role === 'unit_layanan' ? 'bg-light' : '' }}">
                            <div class="d-flex justify-content-between gap-2">
                                <strong>{{ $message->sender_name }}</strong>
                                <time class="small text-muted text-nowrap" datetime="{{ $message->created_at?->toIso8601String() }}">
                                    {{ $message->created_at?->format('d/m/Y H:i') }}
                                </time>
                            </div>
                            <div class="mt-1">{!! nl2br(e($message->message)) !!}</div>
                        </div>
                        @empty
                        <p class="text-muted mb-0">Belum ada pesan dalam percakapan ini.</p>
                        @endforelse
                    </div>
                    <label for="catatanKonfirmasi{{ $sk->id }}" class="form-label-custom">Pesan baru untuk Admin</label>
                    <textarea id="catatanKonfirmasi{{ $sk->id }}" name="catatan_konfirmasi"
                          class="form-control" rows="4" maxlength="5000" required>{{ old('catatan_konfirmasi') }}</textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-primary-custom">Kirim Pesan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
