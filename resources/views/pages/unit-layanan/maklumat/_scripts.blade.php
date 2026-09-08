<script>
    document.addEventListener('DOMContentLoaded', function () {

        /* =====================================================
           CETAK MAKLUMAT
           Menggunakan print browser (frontend-only).
        ====================================================== */
        const printButton = document.getElementById('cetakMaklumatBtn');

        if (printButton) {
            printButton.addEventListener('click', function () {
                window.print();
            });
        }


        /* =====================================================
           SEARCH (client-side)
        ====================================================== */
        const searchInput = document.getElementById('maklumatSearch');
        const table = document.getElementById('maklumatTable');

        if (searchInput && table) {
            searchInput.addEventListener('keyup', function () {

                const keyword = searchInput.value.toLowerCase();
                const rows = table.querySelectorAll('tbody tr');

                rows.forEach(function (row) {

                    const text = row.textContent.toLowerCase();

                    row.style.display = text.includes(keyword)
                        ? ''
                        : 'none';
                });
            });
        }

    });
</script>
