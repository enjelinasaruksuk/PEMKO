/* =========================================================
   TOOLTIP AKSI IKON
   Mengaktifkan Bootstrap Tooltip untuk semua elemen yang
   punya atribut title="..." (ikon Lihat, Edit, Hapus, dll),
   supaya saat kursor didekatkan langsung muncul keterangan
   singkat fungsi tombol tersebut.
========================================================= */

(function () {
    function initTooltips() {
        const elements = document.querySelectorAll('[title]:not([data-tooltip-ready])');

        elements.forEach(function (el) {
            // Hindari elemen tanpa isi title / title kosong
            if (!el.getAttribute('title')) return;

            el.setAttribute('data-tooltip-ready', 'true');

            new bootstrap.Tooltip(el, {
                trigger: 'hover focus',
                placement: 'top',
                delay: { show: 150, hide: 50 },
            });
        });
    }

    document.addEventListener('DOMContentLoaded', initTooltips);

    // Modal Bootstrap (mis. tabel dengan tombol per-baris yang di-render
    // ulang) kadang menambah elemen baru setelah DOMContentLoaded,
    // jadi kita cek ulang tiap kali ada modal yang dibuka.
    document.addEventListener('shown.bs.modal', initTooltips);
})();