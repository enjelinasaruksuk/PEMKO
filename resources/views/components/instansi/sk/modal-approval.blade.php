@props(['sk', 'unit'])

<div class="modal fade" id="modalApprovalSk{{ $sk->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Approval SK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="{{ route('instansi.sk.approve', [$unit, $sk->id]) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <p class="modal-description mb-3">Approval status data SK</p>
                    <select name="status_approval" class="form-select">
                        <option value="disetujui" {{ $sk->pengesahan === 'Sudah disetujui' ? 'selected' : '' }}>Setujui</option>
                        <option value="ditolak">Tolak</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn-primary-custom">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>