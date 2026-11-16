@props(['sk', 'returnToDetail' => false])

<div class="modal fade" id="skConversation{{ $sk->id }}" tabindex="-1"
     aria-labelledby="skConversationTitle{{ $sk->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h2 class="modal-title fs-5" id="skConversationTitle{{ $sk->id }}">Percakapan SK</h2>
                    <p class="text-muted small mb-0">{{ $sk->instansi?->nama_instansi }} · SK {{ $sk->no_sk }}</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-column gap-2 mb-3" style="max-height: 35vh; overflow-y: auto;">
                    @forelse ($sk->messages as $message)
                        <div class="border rounded-3 p-3 {{ $message->sender_role === 'admin' ? 'bg-light' : '' }}">
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

                <form method="POST" action="{{ $sk->review_status === \App\Models\Sk::REVIEW_NEEDS_CHANGES
                    ? route('admin.sk.reply', $sk)
                    : route('admin.sk.return', $sk) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="return_to" value="{{ $returnToDetail ? 'detail' : 'index' }}">
                    <label for="adminReply{{ $sk->id }}" class="form-label">Pesan untuk Unit Pelayanan</label>
                    <textarea id="adminReply{{ $sk->id }}" name="review_comment" class="form-control"
                              rows="3" maxlength="5000" required>{{ old('review_comment') }}</textarea>
                    @if ($sk->review_status !== \App\Models\Sk::REVIEW_NEEDS_CHANGES)
                        <div class="form-text">Pesan ini akan dikirim sekaligus mengembalikan SK untuk diperbaiki.</div>
                    @endif
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="{{ $sk->review_status === \App\Models\Sk::REVIEW_NEEDS_CHANGES ? 'btn-primary-custom' : 'btn btn-outline-danger' }}">
                            <i class="bi bi-send me-1"></i>
                            {{ $sk->review_status === \App\Models\Sk::REVIEW_NEEDS_CHANGES ? 'Kirim Balasan' : 'Kirim & Kembalikan' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
