@php

    $data = $data ?? null;


    $penyampaianFields = [

        'persyaratan' =>
            '1. Persyaratan',

        'sistem_mekanisme_prosedur' =>
            '2. Sistem, Mekanisme dan Prosedur',

        'jangka_waktu' =>
            '3. Jangka Waktu Pelayanan',

        'biaya' =>
            '4. Biaya',

        'produk_pelayanan' =>
            '5. Produk Pelayanan',

        'penanganan_pengaduan' =>
            '6. Penanganan, Pengaduan, Saran dan Masukkan',

    ];


    $pengelolaanFields = [

        'dasar_hukum' =>
            '1. Dasar Hukum',

        'sarana_prasarana' =>
            '2. Sarana dan Prasarana dan/atau fasilitas',

        'kompetensi_pelaksana' =>
            '3. Kompetensi Pelaksana',

        'pengawasan_internal' =>
            '4. Pengawasan Internal',

        'jumlah_pelaksana' =>
            '5. Jumlah Pelaksana',

        'jaminan_pelayanan' =>
            '6. Jaminan Pelayanan',

        'jaminan_keamanan' =>
            '7. Jaminan Keamanan dan Keselamatan Pelayanan',

        'evaluasi_kinerja' =>
            '8. Evaluasi Kinerja Pelaksana',

    ];

@endphp


{{-- ================================================================ --}}
{{-- NAMA LAYANAN --}}
{{-- ================================================================ --}}

<div class="card-custom p-4 mb-4">

    <label class="form-label-custom fw-semibold">

        Nama Layanan:

    </label>


    <input
        type="text"
        name="nama_layanan"
        class="form-control"
        value="{{ old(
            'nama_layanan',
            $data->nama_layanan ?? ''
        ) }}"
        placeholder="Masukkan nama layanan"
        required
    >

</div>



{{-- ================================================================ --}}
{{-- PENYAMPAIAN LAYANAN --}}
{{-- ================================================================ --}}

<div class="card-custom p-4 mb-4">

    <h2 class="section-title mb-4">
        PENYAMPAIAN LAYANAN
    </h2>


    @foreach($penyampaianFields as $name => $label)

        @php

            $value = old(
                $name,
                $data->$name ?? ''
            );

        @endphp


        <div class="mb-4">

            <label class="form-label-custom fw-semibold">

                {{ $label }}

            </label>


            <textarea
                name="{{ $name }}"
                id="{{ $name }}"
                class="rich-text-hidden d-none"
            >{{ $value }}</textarea>


            <div
                id="editor-{{ $name }}"
                class="rich-text-editor"
            >{!! $value !!}</div>

        </div>

    @endforeach

</div>



{{-- ================================================================ --}}
{{-- PENGELOLAAN PELAYANAN --}}
{{-- ================================================================ --}}

<div class="card-custom p-4 mb-4">

    <h2 class="section-title mb-4">
        PENGELOLAAN PELAYANAN
    </h2>


    @foreach($pengelolaanFields as $name => $label)

        @php

            $value = old(
                $name,
                $data->$name ?? ''
            );

        @endphp


        <div class="mb-4">

            <label class="form-label-custom fw-semibold">

                {{ $label }}

            </label>


            <textarea
                name="{{ $name }}"
                id="{{ $name }}"
                class="rich-text-hidden d-none"
            >{{ $value }}</textarea>


            <div
                id="editor-{{ $name }}"
                class="rich-text-editor"
            >{!! $value !!}</div>

        </div>

    @endforeach

</div>



@push('styles')

<link
    href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css"
    rel="stylesheet"
>


<style>

.section-title {

    font-size: 14px;

    font-weight: 700;

    color: #173b69;

}


.rich-text-editor {

    background: #fff;

    min-height: 160px;

    font-size: 13px;

    color: #173b69;

}


.ql-toolbar.ql-snow {

    border: 1px solid #d8d8d8;

    border-radius: 4px 4px 0 0;

    background: #f8f9fa;

}


.ql-container.ql-snow {

    border: 1px solid #d8d8d8;

    border-top: none;

    border-radius: 0 0 4px 4px;

}


.ql-editor {

    min-height: 160px;

    line-height: 1.6;

}


</style>

@endpush



@push('scripts')

<script
    src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"
></script>


<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


        const toolbarOptions = [

            [
                'bold',
                'italic',
                'underline',
                'strike'
            ],

            [
                {
                    header: 1
                },
                {
                    header: 2
                },
                {
                    header: 3
                }
            ],

            [
                {
                    list: 'ordered'
                },
                {
                    list: 'bullet'
                }
            ],

            [
                {
                    indent: '-1'
                },
                {
                    indent: '+1'
                }
            ],

            [
                {
                    align: []
                }
            ],

            [
                'link'
            ],

            [
                'clean'
            ]

        ];


        const editors =
            document.querySelectorAll(
                '.rich-text-editor'
            );


        editors.forEach(
            function (editorElement) {


                const id =
                    editorElement.id.replace(
                        'editor-',
                        ''
                    );


                const textarea =
                    document.getElementById(id);


                const quill =
                    new Quill(
                        '#' + editorElement.id,
                        {

                            theme: 'snow',

                            placeholder:
                                'Masukkan informasi...',

                            modules: {

                                toolbar:
                                    toolbarOptions

                            }

                        }
                    );


                const form =
                    editorElement.closest('form');


                if (form) {

                    form.addEventListener(
                        'submit',
                        function () {

                            textarea.value =
                                quill.root.innerHTML;

                        }
                    );

                }

            }
        );

    }

);

</script>

@endpush