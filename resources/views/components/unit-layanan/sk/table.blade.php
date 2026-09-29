@props(['skList'])

<div class="sk-card">

    {{-- TOOLBAR --}}
    <div class="sk-table-toolbar">
        <div class="sk-show">
            <span>Show</span>
            <select id="skPerPage" class="sk-select">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
            <span>entries</span>
        </div>

        <div class="sk-search">
            <i class="bi bi-search"></i>
            <input type="text" id="skSearch" placeholder="Search:" autocomplete="off">
        </div>
    </div>

    {{-- TABLE --}}
    <div class="sk-table-wrapper">
        <table class="sk-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Dinas</th>
                    <th>No SK</th>
                    <th>Tanggal SK</th>
                    <th>Status</th>
                    <th class="text-center">Proses Pengajuan</th>
                    <th class="text-center">Konfirmasi</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody id="skTableBody">
                @forelse ($skList as $index => $sk)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $sk->nama_dinas ?? 'Bagian Organisasi' }}</td>

                    <td>
                        <div class="sk-number">{{ $sk->no_sk ?? '-' }}</div>
                        @if (($sk->jenis_sk ?? '') === 'Menggantikan SK Sebelumnya')
                        <div class="sk-previous">Menggantikan: {{ $sk->no_sk_sebelumnya ?? '-' }}</div>
                        @endif
                    </td>

                    <td>
                        {{ !empty($sk->tanggal_sk) ? \Carbon\Carbon::parse($sk->tanggal_sk)->format('d/m/Y') : '-' }}
                    </td>

                    <td>
                        <div class="sk-status">
                            @if (($sk->status ?? '') === 'Aktif')
                            <span class="status-active"><i class="bi bi-check-circle"></i> Aktif</span>
                            @else
                            <span class="status-inactive"><i class="bi bi-x-circle"></i> Tidak Aktif</span>
                            @endif

                            @if ($sk->isEditableByOwner())
                            <button type="button" class="sk-icon-btn edit" title="Ubah Status"
                                data-bs-toggle="modal" data-bs-target="#statusModal"
                                data-status-id="{{ $sk->id }}" data-status="{{ $sk->status }}">
                                <i class="bi bi-pencil"></i>
                            </button>
                            @endif
                        </div>
                    </td>

                    <td class="text-center">
                        @if (($sk->pengesahan ?? '') === 'Sudah disetujui')
                        <span class="approval approved"><i class="bi bi-check-circle"></i> Sudah disetujui</span>
                        @else
                            @php
                                $reviewLabels = [
                                    'draft' => 'Belum dikirim',
                                    'menunggu_admin' => 'Menunggu Admin',
                                    'perlu_perbaikan' => 'Perlu diperbaiki',
                                    'menunggu_instansi' => 'Menunggu Instansi',
                                ];
                            @endphp
                            <span class="approval pending">
                                <i class="bi bi-{{ $sk->review_status === 'perlu_perbaikan' ? 'exclamation-circle' : 'clock' }}"></i>
                                {{ $reviewLabels[$sk->review_status] ?? 'Belum dikirim' }}
                            </span>
                            @if ($sk->review_status === 'perlu_perbaikan' && $sk->review_comment)
                            <div class="small text-danger mt-1">{{ $sk->review_comment }}</div>
                            @endif
                        @endif
                    </td>

                    <td class="text-center">
                        @if (($sk->status ?? '') !== 'Aktif')
                        <span class="approval disabled">-</span>
                        @elseif (($sk->pengesahan ?? '') === 'Sudah disetujui'
                            && ($sk->konfirmasi ?? 'Menunggu') === 'Sudah disetujui')
                        <div class="sk-confirmation">
                            <a href="{{ route('pdf.sk', $sk->id) }}" target="_blank"
                               class="sk-icon-btn view" title="Lihat SK">
                                <i class="bi bi-search"></i>
                            </a>
                            <span class="sk-icon-btn success" title="Konfirmasi sudah disetujui">
                                <i class="bi bi-check-circle"></i>
                            </span>
                        </div>
                        @elseif ($sk->review_status === 'menunggu_admin')
                        <span class="approval pending"><i class="bi bi-clock"></i> Menunggu Admin</span>
                        @elseif ($sk->review_status === 'menunggu_instansi')
                        <span class="approval pending"><i class="bi bi-clock"></i> Menunggu Instansi</span>
                        @else
                        <div class="sk-confirmation">
                            <button type="button" class="sk-icon-btn edit" title="Edit catatan konfirmasi"
                                    data-bs-toggle="modal" data-bs-target="#konfirmasiModal{{ $sk->id }}">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <span class="sk-icon-btn clock" title="Belum dikirim untuk diperiksa Admin">
                                <i class="bi bi-clock"></i>
                            </span>
                        </div>
                        @endif
                    </td>

                    <td class="text-center">
                        <div class="sk-actions">
                            @if (($sk->status ?? '') === 'Aktif')
                            <a href="{{ route('unit_layanan.sk.layanan', $sk->id) }}"
                               class="sk-icon-btn view" title="Kelola layanan pada SK">
                                <i class="bi bi-clipboard"></i>
                            </a>
                            @if (($sk->review_status ?? '') === 'disetujui' && ($sk->konfirmasi ?? '') === 'Sudah disetujui')
                            <a href="{{ route('pdf.sk', $sk->id) }}"
                                target="_blank"
                                class="sk-icon-btn pdf"
                                title="Cetak PDF">
                                <i class="bi bi-file-earmark-pdf"></i>
                            </a>
                            @elseif (($sk->pengesahan ?? '') === 'Sudah disetujui')
                            <span class="sk-icon-btn" style="color:#a7b1be; cursor:not-allowed;" title="Konfirmasi belum disetujui">
                                <i class="bi bi-file-earmark-pdf"></i>
                            </span>
                            @endif
                            @if ($sk->isEditableByOwner())
                            <button type="button" class="sk-icon-btn edit" title="Edit"
                                data-bs-toggle="modal" data-bs-target="#skModal"
                                data-sk-id="{{ $sk->id }}"
                                data-no-sk="{{ $sk->no_sk }}"
                                data-tanggal-sk="{{ $sk->tanggal_sk }}"
                                data-jenis-sk="{{ $sk->jenis_sk }}"
                                data-no-sk-sebelumnya="{{ $sk->no_sk_sebelumnya }}">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button type="button" class="sk-icon-btn delete" title="Hapus"
                                data-bs-toggle="modal" data-bs-target="#deleteSKModal"
                                data-delete-id="{{ $sk->id }}">
                                <i class="bi bi-trash"></i>
                            </button>
                            @if (($sk->status ?? '') === 'Aktif' && $sk->pelayanan_count > 0)
                            <form method="POST" action="{{ route('unit_layanan.sk.submit', $sk) }}"
                                  onsubmit="return confirm('Kirim SK ke Admin untuk diperiksa?')">
                                @csrf
                                <button type="submit" class="sk-icon-btn success" title="Kirim ke Admin">
                                    <i class="bi bi-send"></i>
                                </button>
                            </form>
                            @endif
                            @endif
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">
                        <div class="sk-empty">
                            <i class="bi bi-inbox"></i>
                            <div>Belum ada data SK.</div>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    <div class="sk-pagination">
        <button type="button" title="Halaman pertama"><i class="bi bi-chevron-double-left"></i></button>
        <button type="button" title="Sebelumnya"><i class="bi bi-chevron-left"></i></button>
        <button type="button" class="active">1</button>
        <button type="button" title="Berikutnya"><i class="bi bi-chevron-right"></i></button>
        <button type="button" title="Halaman terakhir"><i class="bi bi-chevron-double-right"></i></button>
    </div>

</div>