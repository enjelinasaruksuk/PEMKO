@props(['maklumatList'])

<div class="maklumat-card">

    {{-- TOOLBAR --}}
    <div class="maklumat-table-toolbar">

        <div class="maklumat-search">
            <i class="bi bi-search"></i>
            <input type="text" id="maklumatSearch" placeholder="Search:" autocomplete="off">
        </div>

        @if ($maklumatList->isNotEmpty())
        <a href="{{ route('pdf.maklumat', $maklumatList->first()) }}" target="_blank"
           class="maklumat-print-button text-decoration-none">
            <i class="bi bi-printer"></i>
            <span>Cetak Maklumat</span>
        </a>
        @endif

    </div>

    {{-- TABLE --}}
    <div class="maklumat-table-wrapper">
        <table class="maklumat-table" id="maklumatTable">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Maklumat</th>
                    <th>Ttd / Nama Pejabat</th>
                    <th>Tanggal Input Maklumat</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($maklumatList as $index => $maklumat)
                <tr>
                    <td class="text-center">{{ $index + 1 }}.</td>
                    <td class="maklumat-content">{{ $maklumat->isi_maklumat ?? '-' }}</td>
                    <td>
                        {{ $maklumat->nama_penjabat ?? '-' }}
                        @if ($loop->first)
                        <span class="badge bg-success ms-1" style="font-size:10px;">Aktif</span>
                        @endif
                    </td>
                    <td>
                        {{ !empty($maklumat->tanggal_input) ? \Carbon\Carbon::parse($maklumat->tanggal_input)->translatedFormat('d F Y') : '-' }}
                    </td>
                    <td class="text-center">
                        <a href="{{ route('pdf.maklumat', $maklumat) }}" target="_blank"
                           class="sk-icon-btn pdf" title="Cetak PDF Maklumat">
                            <i class="bi bi-file-earmark-pdf"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">
                        <div class="maklumat-empty">
                            <i class="bi bi-inbox"></i>
                            <div>Belum ada data Maklumat.</div>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    <div class="maklumat-pagination">
        <button type="button" title="Halaman pertama"><i class="bi bi-chevron-double-left"></i></button>
        <button type="button" title="Sebelumnya"><i class="bi bi-chevron-left"></i></button>
        <button type="button" class="active">1</button>
        <button type="button" title="Berikutnya"><i class="bi bi-chevron-right"></i></button>
        <button type="button" title="Halaman terakhir"><i class="bi bi-chevron-double-right"></i></button>
    </div>

</div>