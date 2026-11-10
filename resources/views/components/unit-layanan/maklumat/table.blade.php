@props(['maklumatList'])

<div class="dt-card" style="margin:0;">

    <div class="dt-table-toolbar">
        <div class="dt-search">
            <i class="bi bi-search"></i>
            <input type="text" id="maklumatSearch" placeholder="Cari maklumat..." autocomplete="off">
        </div>

        @if ($maklumatList->isNotEmpty())
            <a href="{{ route('pdf.maklumat', $maklumatList->first()) }}" target="_blank"
               class="btn-primary-custom text-decoration-none">
                <i class="bi bi-printer me-1"></i> Cetak Maklumat
            </a>
        @endif
    </div>

    <div class="dt-table-wrapper">
        <table class="dt-table" id="maklumatTable">
            <thead>
                <tr>
                    <th style="width:50px">No</th>
                    <th>Maklumat</th>
                    <th class="dt-nowrap">Nama Pejabat</th>
                    <th class="dt-nowrap">Tanggal Input</th>
                    <th class="text-center" style="width:90px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($maklumatList as $i => $maklumat)
                    <tr class="maklumat-row">
                        <td>{{ $i + 1 }}</td>
                        <td class="dt-cell-wrap">{{ $maklumat->isi_maklumat ?? '-' }}</td>
                        <td class="dt-nowrap">
                            {{ $maklumat->nama_penjabat ?? '-' }}
                            @if ($loop->first)
                                <span class="dt-badge green ms-1">Aktif</span>
                            @endif
                        </td>
                        <td class="dt-nowrap">{{ $maklumat->tanggal_input?->translatedFormat('d F Y') ?? '-' }}</td>
                        <td>
                            <div class="dt-actions justify-content-center">
                                <a href="{{ route('pdf.maklumat', $maklumat) }}" target="_blank"
                                   class="dt-icon-btn pdf" title="Cetak Maklumat PDF">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach

                <tr id="maklumatEmptyRow" class="{{ $maklumatList->isEmpty() ? '' : 'd-none' }}">
                    <td colspan="5">
                        <div class="dt-empty">
                            <i class="bi bi-inbox"></i>
                            <div>Belum ada data maklumat.</div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('maklumatSearch');
    const emptyRow = document.getElementById('maklumatEmptyRow');
    const rows = Array.from(document.querySelectorAll('#maklumatTable .maklumat-row'));

    searchInput.addEventListener('input', function () {
        const keyword = this.value.toLowerCase().trim();
        let shown = 0;
        rows.forEach(function (row) {
            const match = !keyword || row.textContent.toLowerCase().includes(keyword);
            row.style.display = match ? '' : 'none';
            if (match) shown++;
        });
        emptyRow.classList.toggle('d-none', shown > 0);
    });
});
</script>
@endpush