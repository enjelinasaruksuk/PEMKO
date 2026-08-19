<div class="sk-card">

    {{-- TOOLBAR --}}
    <div class="sk-table-toolbar">

        <div class="sk-show">

            <span>
                Show
            </span>

            <select
                id="skPerPage"
                class="sk-select"
            >
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>

            <span>
                entries
            </span>

        </div>


        <div class="sk-search">

            <i class="bi bi-search"></i>

            <input
                type="text"
                id="skSearch"
                placeholder="Search:"
                autocomplete="off"
            >

        </div>

    </div>


    {{-- TABLE --}}
    <div class="sk-table-wrapper">

        <table class="sk-table">

            <thead>

                <tr>

                    <th>
                        No
                    </th>

                    <th>
                        Nama Dinas
                    </th>

                    <th>
                        No SK
                    </th>

                    <th>
                        Tanggal SK
                    </th>

                    <th>
                        Status
                    </th>

                    <th class="text-center">
                        Pengesahan SK
                        <span>
                            (Kepala PD)
                        </span>
                    </th>

                    <th class="text-center">
                        Konfirmasi
                    </th>

                    <th class="text-center">
                        Actions
                    </th>

                </tr>

            </thead>


            <tbody id="skTableBody">

                @forelse($skList as $index => $sk)

                    <tr>

                        {{-- NO --}}
                        <td class="text-center">
                            {{ $index + 1 }}
                        </td>


                        {{-- NAMA DINAS --}}
                        <td>
                            {{ $sk->nama_dinas ?? 'Bagian Organisasi' }}
                        </td>


                        {{-- NO SK --}}
                        <td>

                            <div class="sk-number">
                                {{ $sk->no_sk ?? '-' }}
                            </div>

                            @if(
                                ($sk->jenis_sk ?? '') ===
                                'Menggantikan SK Sebelumnya'
                            )

                                <div class="sk-previous">

                                    Menggantikan:
                                    {{ $sk->no_sk_sebelumnya ?? '-' }}

                                </div>

                            @endif

                        </td>


                        {{-- TANGGAL --}}
                        <td>

                            @if(!empty($sk->tanggal_sk))

                                {{ \Carbon\Carbon::parse($sk->tanggal_sk)->format('d/m/Y') }}

                            @else

                                -

                            @endif

                        </td>


                        {{-- STATUS --}}
                        <td>

                            <div class="sk-status">

                                @if(($sk->status ?? '') === 'Aktif')

                                    <span class="status-active">

                                        <i class="bi bi-check-circle"></i>

                                        Aktif

                                    </span>

                                @else

                                    <span class="status-inactive">

                                        <i class="bi bi-x-circle"></i>

                                        Tidak Aktif

                                    </span>

                                @endif


                                {{-- UBAH STATUS --}}
                                <button
                                    type="button"
                                    class="sk-icon-btn edit"
                                    title="Ubah Status"

                                    data-bs-toggle="modal"
                                    data-bs-target="#statusModal"

                                    data-status-id="{{ $sk->id }}"
                                    data-status="{{ $sk->status }}"
                                >

                                    <i class="bi bi-pencil"></i>

                                </button>

                            </div>

                        </td>


                        {{-- PENGESAHAN --}}
                        <td class="text-center">

                            @if(($sk->status ?? '') === 'Aktif')

                                @if(
                                    ($sk->pengesahan ?? '') ===
                                    'Sudah disetujui'
                                )

                                    <span class="approval approved">

                                        <i class="bi bi-check-circle"></i>

                                        Sudah disetujui

                                    </span>

                                @else

                                    <span class="approval pending">

                                        <i class="bi bi-clock"></i>

                                        Belum disetujui

                                    </span>

                                @endif

                            @else

                                <span class="approval disabled">
                                    -
                                </span>

                            @endif

                        </td>


                        {{-- KONFIRMASI --}}
                        <td class="text-center">

                            @if(($sk->status ?? '') === 'Aktif')

                                <div class="sk-confirmation">

                                    @if(
                                        ($sk->pengesahan ?? '') ===
                                        'Sudah disetujui'
                                    )

                                        <button
                                            type="button"
                                            class="sk-icon-btn view"
                                            title="Lihat Konfirmasi"

                                            data-detail-id="{{ $sk->id }}"
                                        >

                                            <i class="bi bi-book"></i>

                                        </button>


                                        <button
                                            type="button"
                                            class="sk-icon-btn success"
                                            title="Sudah dikonfirmasi"
                                        >

                                            <i class="bi bi-check-circle"></i>

                                        </button>

                                    @else

                                        <button
                                            type="button"
                                            class="sk-icon-btn edit"
                                            title="Konfirmasi"

                                            data-confirmation-id="{{ $sk->id }}"
                                        >

                                            <i class="bi bi-pencil"></i>

                                        </button>


                                        <button
                                            type="button"
                                            class="sk-icon-btn clock"
                                            title="Menunggu konfirmasi"
                                        >

                                            <i class="bi bi-clock"></i>

                                        </button>

                                    @endif

                                </div>

                            @else

                                <span class="approval disabled">
                                    -
                                </span>

                            @endif

                        </td>


                        {{-- ACTIONS --}}
                        <td class="text-center">

                            <div class="sk-actions">

                                {{-- PDF --}}
                                <button
                                    type="button"
                                    class="sk-icon-btn pdf"
                                    title="PDF"
                                    data-pdf-id="{{ $sk->id }}"
                                >

                                    <i class="bi bi-file-earmark-pdf"></i>

                                </button>


                                {{-- EDIT --}}
                                @if(
                                    ($sk->pengesahan ?? '') !==
                                    'Sudah disetujui'
                                )

                                    <button
                                        type="button"
                                        class="sk-icon-btn edit"
                                        title="Edit"

                                        data-bs-toggle="modal"
                                        data-bs-target="#skModal"

                                        data-sk-id="{{ $sk->id }}"
                                        data-no-sk="{{ $sk->no_sk }}"
                                        data-tanggal-sk="{{ $sk->tanggal_sk }}"
                                        data-jenis-sk="{{ $sk->jenis_sk }}"
                                        data-no-sk-sebelumnya="{{ $sk->no_sk_sebelumnya }}"
                                    >

                                        <i class="bi bi-pencil"></i>

                                    </button>

                                @endif


                                {{-- DETAIL --}}
                                <button
                                    type="button"
                                    class="sk-icon-btn view"
                                    title="Detail"
                                    data-detail-id="{{ $sk->id }}"
                                >

                                    <i class="bi bi-file-text"></i>

                                </button>


                                {{-- DELETE --}}
                                @if(
                                    ($sk->pengesahan ?? '') !==
                                    'Sudah disetujui'
                                )

                                    <button
                                        type="button"
                                        class="sk-icon-btn delete"
                                        title="Hapus"

                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteSKModal"

                                        data-delete-id="{{ $sk->id }}"
                                    >

                                        <i class="bi bi-trash"></i>

                                    </button>

                                @endif

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="8"
                            class="text-center"
                        >

                            <div class="sk-empty">

                                <i class="bi bi-inbox"></i>

                                <div>
                                    Belum ada data SK.
                                </div>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- PAGINATION --}}
    <div class="sk-pagination">

        <button
            type="button"
            title="Halaman pertama"
        >
            <i class="bi bi-chevron-double-left"></i>
        </button>


        <button
            type="button"
            title="Sebelumnya"
        >
            <i class="bi bi-chevron-left"></i>
        </button>


        <button
            type="button"
            class="active"
        >
            1
        </button>


        <button
            type="button"
            title="Berikutnya"
        >
            <i class="bi bi-chevron-right"></i>
        </button>


        <button
            type="button"
            title="Halaman terakhir"
        >
            <i class="bi bi-chevron-double-right"></i>
        </button>

    </div>

</div>