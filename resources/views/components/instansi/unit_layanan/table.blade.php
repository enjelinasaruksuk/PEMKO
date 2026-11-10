@props(['unitLayananList'])

@php
    $badge = function (?string $status): array {
        return match (strtolower((string) $status)) {
            'aktif'    => ['green', 'Aktif'],
            'pending'  => ['blue', 'Menunggu persetujuan'],
            'nonaktif' => ['gray', 'Nonaktif'],
            'ditolak'  => ['gray', 'Ditolak'],
            default    => ['gray', 'Belum ada akun'],
        };
    };
@endphp

<div class="dt-card" style="margin:0;">

    <div class="dt-table-toolbar">
        <div class="dt-show">
            <span>Show</span>
            <select id="unitPerPage" class="dt-select">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
            <span>entries</span>
            <span class="ms-3">{{ $unitLayananList->count() }} unit terdaftar</span>
        </div>

        <div class="dt-search">
            <i class="bi bi-search"></i>
            <input type="text" id="unitLayananSearch" placeholder="Cari unit layanan..." autocomplete="off">
        </div>
    </div>

    <div class="dt-table-wrapper">
        <table class="dt-table">
            <thead>
                <tr>
                    <th style="width:50px">No</th>
                    <th>Unit Layanan</th>
                    <th>Email Akun</th>
                    <th>Username</th>
                    <th>Status Unit</th>
                    <th>Status Akun</th>
                    <th>Masuk Terakhir</th>
                </tr>
            </thead>
            <tbody id="unitLayananTableBody">
                @foreach ($unitLayananList as $unit)
                    @php
                        $akun = $unit->pengguna->first();
                        [$warnaUnit, $labelUnit] = $badge($unit->status);
                        [$warnaAkun, $labelAkun] = $badge($akun?->status);
                    @endphp
                    <tr class="unit-row">
                        <td class="unit-no">{{ $loop->iteration }}</td>
                        <td class="fw-semibold text-primary">{{ $unit->nama_instansi }}</td>
                        <td>{{ $akun?->email ?? $unit->email_instansi ?? '-' }}</td>
                        <td>{{ $akun?->username ?? '-' }}</td>
                        <td><span class="dt-badge {{ $warnaUnit }}">{{ $labelUnit }}</span></td>
                        <td><span class="dt-badge {{ $warnaAkun }}">{{ $labelAkun }}</span></td>
                        <td>{{ $akun?->masuk_terakhir?->format('d M Y H:i') ?? '-' }}</td>
                    </tr>
                @endforeach

                <tr id="unitEmptyRow" class="{{ $unitLayananList->isEmpty() ? '' : 'd-none' }}">
                    <td colspan="7">
                        <div class="dt-empty">
                            <i class="bi bi-inbox"></i>
                            <div>Belum ada data unit layanan.</div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="dt-pagination" id="unitPagination"></div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('unitLayananSearch');
    const perPageSelect = document.getElementById('unitPerPage');
    const pagination = document.getElementById('unitPagination');
    const emptyRow = document.getElementById('unitEmptyRow');
    const rows = Array.from(document.querySelectorAll('#unitLayananTableBody .unit-row'));

    let currentPage = 1;

    function filteredRows() {
        const keyword = searchInput.value.toLowerCase().trim();
        return rows.filter(row => !keyword || row.textContent.toLowerCase().includes(keyword));
    }

    function pageButton(html, page, { active = false, disabled = false, title = '' } = {}) {
        const button = document.createElement('button');
        button.type = 'button';
        button.innerHTML = html;
        button.title = title;
        button.disabled = disabled;
        if (active) button.classList.add('active');
        button.addEventListener('click', () => { currentPage = page; render(); });
        return button;
    }

    function render() {
        const perPage = parseInt(perPageSelect.value, 10);
        const matched = filteredRows();
        const totalPages = Math.max(1, Math.ceil(matched.length / perPage));
        currentPage = Math.min(currentPage, totalPages);

        const start = (currentPage - 1) * perPage;
        const visible = new Set(matched.slice(start, start + perPage));

        rows.forEach(row => { row.style.display = visible.has(row) ? '' : 'none'; });

        // Nomor urut mengikuti hasil filter
        matched.forEach((row, i) => { row.querySelector('.unit-no').textContent = i + 1; });

        if (emptyRow) emptyRow.classList.toggle('d-none', matched.length > 0);

        pagination.innerHTML = '';
        pagination.appendChild(pageButton('<i class="bi bi-chevron-double-left"></i>', 1, { disabled: currentPage === 1, title: 'Halaman pertama' }));
        pagination.appendChild(pageButton('<i class="bi bi-chevron-left"></i>', currentPage - 1, { disabled: currentPage === 1, title: 'Sebelumnya' }));

        for (let p = 1; p <= totalPages; p++) {
            pagination.appendChild(pageButton(p, p, { active: p === currentPage }));
        }

        pagination.appendChild(pageButton('<i class="bi bi-chevron-right"></i>', currentPage + 1, { disabled: currentPage === totalPages, title: 'Berikutnya' }));
        pagination.appendChild(pageButton('<i class="bi bi-chevron-double-right"></i>', totalPages, { disabled: currentPage === totalPages, title: 'Halaman terakhir' }));
    }

    searchInput.addEventListener('input', () => { currentPage = 1; render(); });
    perPageSelect.addEventListener('change', () => { currentPage = 1; render(); });

    render();
});
</script>
@endpush