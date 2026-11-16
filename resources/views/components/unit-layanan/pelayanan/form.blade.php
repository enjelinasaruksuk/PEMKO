@props(['data' => null, 'komponenList' => [], 'komponenMap' => []])

<div class="card-custom p-4 mb-4">
    <label class="form-label-custom fw-semibold">Nama Layanan: <span class="text-danger">*</span></label>
    <input type="text" name="nama_layanan" id="namaLayanan" class="form-control"
           value="{{ old('nama_layanan', $data->nama_layanan ?? '') }}"
           placeholder="Masukkan nama layanan">
    <div class="field-error text-danger small mt-1 d-none" id="error-namaLayanan">Nama layanan wajib diisi.</div>
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
                <div class="mb-4" id="wrap-{{ $fieldKey }}">
                    <label class="form-label-custom fw-semibold">{{ $i + 1 }}. {{ $komponen->nama_komponen }} <span class="text-danger">*</span></label>
                    <textarea name="komponen[{{ $komponen->id_komponen }}]" id="{{ $fieldKey }}" class="rich-text-hidden d-none">{{ $value }}</textarea>
                    <div id="editor-{{ $fieldKey }}" class="rich-text-editor">{!! $value !!}</div>
                    <div class="field-error text-danger small mt-1 d-none" id="error-{{ $fieldKey }}">
                        {{ $komponen->nama_komponen }} wajib diisi.
                    </div>
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
    .field-invalid .ql-toolbar.ql-snow,
    .field-invalid .ql-container.ql-snow { border-color: #dc3545; }
    .input-invalid { border-color: #dc3545 !important; }
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

    const items = []; // { quill, wrap, error, textarea }
    const namaInput = document.getElementById('namaLayanan');
    const namaError = document.getElementById('error-namaLayanan');

    function isEmpty(quill) {
        return quill.getText().trim() === '';
    }

    function showFieldError(it, show) {
        it.wrap.classList.toggle('field-invalid', show);
        it.error.classList.toggle('d-none', !show);
    }

    function showNamaError(show) {
        namaInput.classList.toggle('input-invalid', show);
        namaError.classList.toggle('d-none', !show);
    }

    document.querySelectorAll('.rich-text-editor').forEach(function (editorElement) {
        const id = editorElement.id.replace('editor-', '');

        const quill = new Quill('#' + editorElement.id, {
            theme: 'snow',
            placeholder: 'Masukkan informasi...',
            modules: { toolbar: toolbarOptions },
        });

        const it = {
            quill: quill,
            wrap: document.getElementById('wrap-' + id),
            error: document.getElementById('error-' + id),
            textarea: document.getElementById(id),
        };
        items.push(it);

        quill.on('text-change', function () {
            // Peringatan hilang begitu field terisi
            if (!isEmpty(quill)) showFieldError(it, false);
        });
    });

    namaInput.addEventListener('input', function () {
        if (namaInput.value.trim() !== '') showNamaError(false);
    });
    namaInput.addEventListener('blur', function () {
        showNamaError(namaInput.value.trim() === '');
    });

    const form = namaInput.closest('form');
    if (form) {
        form.noValidate = true;

        form.addEventListener('submit', function (e) {
            let firstInvalid = null;

            if (namaInput.value.trim() === '') {
                showNamaError(true);
                firstInvalid = namaInput;
            }

            items.forEach(function (it) {
                const kosong = isEmpty(it.quill);
                showFieldError(it, kosong);
                if (kosong && !firstInvalid) firstInvalid = it.wrap;
            });

            if (firstInvalid) {
                e.preventDefault();
                firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                return;
            }

            items.forEach(function (it) {
                it.textarea.value = it.quill.root.innerHTML;
            });
        });
    }

});
</script>
@endpush