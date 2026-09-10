@props(['perda', 'index' => 0])

@php
    $id = is_object($perda) ? $perda->id : $index;
    $tentang = is_object($perda) ? $perda->tentang : $perda;
@endphp

<div class="modal fade" id="editPerdaModal{{ $id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form method="POST" action="#">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Peraturan Daerah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p class="modal-description mb-3">Ubah Peraturan Daerah di bawah ini.</p>
                    <div>
                        <label class="form-label-custom">Peraturan Daerah</label>
                        <textarea name="perda" class="form-control modal-field" rows="5" style="resize: vertical; min-height: 120px;">{{ $tentang }}</textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-primary-custom">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>