@props(['data' => null, 'komponenList' => [], 'komponenMap' => []])

<div class="card-custom p-4 mb-4">
    <label class="form-label-custom fw-semibold">Nama Layanan:</label>
    <input type="text" name="nama_layanan" class="form-control"
           value="{{ old('nama_layanan', $data->nama_layanan ?? '') }}"
           placeholder="Masukkan nama layanan" required>
</div>

@foreach (['Penyampaian' => 'PENYAMPAIAN LAYANAN', 'Pengelolaan' => 'PENGELOLAAN PELAYANAN'] as $kategori => $judulSection)
    @if (isset($komponenList[$kategori]))
        <div class="card-custom p-4 mb-4">
            <h2 class="section-title text-center mb-4">{{ $judulSection }}</h2>

            @foreach ($komponenList[$kategori] as $i => $komponen)
                @php
                    $fieldKey = 'komponen_' . $komponen->id_komponen;
                    $value = old('komponen.' . $komponen->id_komponen, $komponenMap[$komponen->id_komponen] ?? '');
                @endphp
                <div class="mb-4">
                    <label class="form-label-custom fw-semibold">{{ $i + 1 }}. {{ $komponen->nama_komponen }}</label>
                    <textarea name="komponen[{{ $komponen->id_komponen }}]" id="{{ $fieldKey }}" class="rich-text-hidden d-none">{{ $value }}</textarea>
                    <div id="editor-{{ $fieldKey }}" class="rich-text-editor">{!! $value !!}</div>
                </div>
            @endforeach
        </div>
    @endif
@endforeach

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">
<style>
    .section-title { font-size: 14px; font-weight: 700; color: #173b69; }
    .rich-text-editor { background: #fff; min-height: 160px; font-size: 13px; color: #173b69; }
    .ql-toolbar.ql-snow { border: 1px solid #d8d8d8; border-radius: 4px 4px 0 0; background: #f8f9fa; }
    .ql-container.ql-snow { border: 1px solid #d8d8d8; border-top: none; border-radius: 0 0 4px 4px; }
    .ql-editor { min-height: 160px; line-height: 1.6; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],
        [{ header: 1 }, { header: 2 }, { header: 3 }],
        [{ list: 'ordered' }, { list: 'bullet' }],
        [{ indent: '-1' }, { indent: '+1' }],
        [{ align: [] }],
        ['link'],
        ['clean'],
    ];

    document.querySelectorAll('.rich-text-editor').forEach(function (editorElement) {
        const id = editorElement.id.replace('editor-', '');
        const textarea = document.getElementById(id);

        const quill = new Quill('#' + editorElement.id, {
            theme: 'snow',
            placeholder: 'Masukkan informasi...',
            modules: { toolbar: toolbarOptions },
        });

        const form = editorElement.closest('form');
        if (form) {
            form.addEventListener('submit', function () {
                textarea.value = quill.root.innerHTML;
            });
        }
    });
});
</script>
@endpush