<script>

document.addEventListener('DOMContentLoaded', function () {

    const skModal = document.getElementById('skModal');
    const skForm = document.getElementById('skForm');
    const skModalTitle = document.getElementById('skModalTitle');
    const skModalDescription = document.getElementById('skModalDescription');
    const skMethod = document.getElementById('skMethod');
    const noSK = document.getElementById('noSK');
    const tanggalSK = document.getElementById('tanggalSK');
    const jenisSK = document.getElementById('jenisSK');
    const noSkSebelumnyaWrapper = document.getElementById('noSkSebelumnyaWrapper');
    const noSkSebelumnya = document.getElementById('noSkSebelumnya');

    const baseUrl = "{{ url('/instansi/pengesahan-sk') }}";

    function togglePreviousSK() {
        if (jenisSK.value === 'Menggantikan SK Sebelumnya') {
            noSkSebelumnyaWrapper.style.display = 'block';
            noSkSebelumnya.required = true;
        } else {
            noSkSebelumnyaWrapper.style.display = 'none';
            noSkSebelumnya.required = false;
            noSkSebelumnya.value = '';
        }
    }

    if (jenisSK) {
        jenisSK.addEventListener('change', togglePreviousSK);
    }

    if (skModal) {
        skModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;

            if (!button || !button.hasAttribute('data-sk-id')) {
                skModalTitle.textContent = 'Tambah SK';
                skModalDescription.textContent = 'Isilah form di bawah ini untuk menambah data SK baru.';
                skForm.action = "{{ route('instansi.sk.store') }}";
                skMethod.value = 'POST';
                noSK.value = '';
                tanggalSK.value = '';
                jenisSK.value = '';
                noSkSebelumnya.value = '';
                togglePreviousSK();
                return;
            }

            const id = button.getAttribute('data-sk-id');
            const no = button.getAttribute('data-no-sk');
            const tanggal = button.getAttribute('data-tanggal-sk');
            const jenis = button.getAttribute('data-jenis-sk');
            const previous = button.getAttribute('data-no-sk-sebelumnya');

            skModalTitle.textContent = 'Edit SK';
            skModalDescription.textContent = 'Perbarui informasi data SK di bawah ini.';
            skForm.action = `${baseUrl}/${id}`;
            skMethod.value = 'PUT';
            noSK.value = no || '';
            tanggalSK.value = tanggal || '';
            jenisSK.value = jenis || '';
            noSkSebelumnya.value = previous || '';
            togglePreviousSK();
        });
    }

    const statusModal = document.getElementById('statusModal');
    const statusForm = document.getElementById('statusForm');
    const statusSkId = document.getElementById('statusSkId');
    const statusSK = document.getElementById('statusSK');

    if (statusModal) {
        statusModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            if (!button) return;

            const id = button.getAttribute('data-status-id');
            const status = button.getAttribute('data-status');

            statusSkId.value = id || '';
            statusSK.value = status || '';
            statusForm.action = `${baseUrl}/${id}/status`;
        });
    }

    const deleteModal = document.getElementById('deleteSKModal');
    const deleteForm = document.getElementById('deleteSKForm');

    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            if (!button) return;

            const id = button.getAttribute('data-delete-id');
            deleteForm.action = `${baseUrl}/${id}`;
        });
    }

    const searchInput = document.getElementById('skSearch');
    const tableBody = document.getElementById('skTableBody');

    if (searchInput && tableBody) {
        searchInput.addEventListener('input', function () {
            const keyword = this.value.toLowerCase().trim();
            tableBody.querySelectorAll('tr').forEach(function (row) {
                const text = row.textContent.toLowerCase();
                row.style.display = (!keyword || text.includes(keyword)) ? '' : 'none';
            });
        });
    }

    document.querySelectorAll('[data-detail-id]').forEach(function (button) {
        button.addEventListener('click', function () {
            alert('Detail SK ID: ' + this.getAttribute('data-detail-id'));
        });
    });

    document.querySelectorAll('[data-pdf-id]').forEach(function (button) {
        button.addEventListener('click', function () {
            alert('Fitur PDF untuk SK ID ' + this.getAttribute('data-pdf-id') + ' belum tersedia.');
        });
    });

});

</script>