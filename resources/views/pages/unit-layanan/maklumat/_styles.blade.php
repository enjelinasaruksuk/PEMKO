<style>

    .maklumat-page-header {
        margin-bottom: 20px;
    }

    .maklumat-page-title {
        font-size: 20px;
        font-weight: 700;
        color: var(--text);
        margin: 0 0 4px;
    }

    .maklumat-page-subtitle {
        font-size: 12px;
        color: #8d939c;
        margin: 0;
    }

    .maklumat-card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 7px rgba(0, 0, 0, .12);
        padding: 20px;
    }

    .maklumat-table-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 16px;
        flex-wrap: wrap;
    }

    .maklumat-search {
        display: flex;
        align-items: center;
        gap: 6px;
        border: 1px solid var(--border);
        border-radius: 4px;
        padding: 6px 10px;
        max-width: 220px;
        font-size: 12px;
        color: #8d939c;
    }

    .maklumat-search input {
        border: none;
        outline: none;
        font-size: 12px;
        width: 100%;
    }

    .maklumat-print-button {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--primary);
        border: none;
        color: #fff;
        border-radius: 20px;
        padding: 8px 18px;
        font-size: 12px;
        cursor: pointer;
        transition: .2s;
    }

    .maklumat-print-button:hover {
        background: var(--primary-dark);
    }

    .maklumat-table-wrapper {
        overflow-x: auto;
    }

    .maklumat-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 12px;
    }

    .maklumat-table th,
    .maklumat-table td {
        border: 1px solid var(--border);
        padding: 10px 12px;
        color: var(--text);
        vertical-align: top;
    }

    .maklumat-table thead th {
        background: #f5f6f8;
        font-weight: 600;
        text-align: left;
        white-space: nowrap;
    }

    .maklumat-content {
        text-align: justify;
        line-height: 1.6;
    }

    .maklumat-empty {
        color: #8d939c;
        font-size: 12px;
        padding: 25px 0;
        text-align: center;
    }

    .maklumat-empty i {
        font-size: 28px;
        display: block;
        margin-bottom: 8px;
    }

    .maklumat-pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 4px;
        margin-top: 20px;
    }

    .maklumat-pagination button {
        border: 1px solid #ddd;
        background: #fff;
        color: #555;
        border-radius: 4px;
        min-width: 30px;
        height: 30px;
        font-size: 11px;
        cursor: pointer;
    }

    .maklumat-pagination button:hover {
        background: #f1f3f5;
    }

    .maklumat-pagination button.active {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    /* Sembunyikan elemen yang tidak perlu saat print */
    @media print {
        .top-header,
        .unit-sidebar,
        .maklumat-table-toolbar,
        .maklumat-pagination {
            display: none !important;
        }

        .maklumat-card {
            box-shadow: none;
            padding: 0;
        }
    }

</style>