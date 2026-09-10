@props(['perwali', 'index' => 0])

@php
    $id = is_object($perwali) ? $perwali->id : $index;
    $tentang = is_object($perwali) ? $perwali->tentang : $perwali;
@endphp

<div class="modal fade" id="editPerwaliModal{{ $id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form method="POST" action="#">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Peraturan Wali Kota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p class="modal-description mb-3">Ubah Peraturan Wali Kota di bawah ini.</p>
                    <div>
                        <label class="form-label-custom">Peraturan Wali Kota</label>
                        <textarea name="perwali" class="form-control modal-field" rows="5" style="resize: vertical; min-height: 120px;">{{ $tentang }}</textarea>
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