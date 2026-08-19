<style>

/* =========================================================
   PAGE
========================================================= */

.sk-page {
    width: 100%;
}


/* =========================================================
   PAGE HEADER
========================================================= */

.sk-page-header {
    margin-bottom: 28px;
}

.sk-page-title {
    margin: 0 0 6px;

    font-size: 28px;
    line-height: 1.3;
    font-weight: 600;

    color: #163f73;
}

.sk-page-subtitle {
    margin: 0;

    font-size: 15px;
    line-height: 1.5;

    color: #9aa7b8;
}


/* =========================================================
   MAIN CARD
========================================================= */

.sk-main-card {
    width: 100%;

    background: #fff;

    border-radius: 10px;

    box-shadow:
        0 2px 8px rgba(0, 0, 0, .10);

    overflow: hidden;
}


/* =========================================================
   ORGANIZATION HEADER
========================================================= */

.sk-organization-header {
    min-height: 70px;

    display: flex;

    align-items: center;
    justify-content: space-between;

    padding: 0 24px;
}

.sk-organization-title {
    display: flex;

    align-items: center;

    gap: 12px;

    font-size: 17px;
    font-weight: 600;

    color: #204b7d;
}

.sk-organization-icon {
    width: 38px;
    height: 38px;

    display: inline-flex;

    align-items: center;
    justify-content: center;

    border-radius: 8px;

    background: #edf5ff;

    color: #2878d7;

    font-size: 18px;
}

.sk-chevron-button {
    width: 34px;
    height: 34px;

    border: 0;

    background: transparent;

    color: #71839a;

    cursor: pointer;

    font-size: 15px;
}


/* =========================================================
   DIVIDER
========================================================= */

.sk-divider {
    height: 1px;

    background: #e7ebf0;
}


/* =========================================================
   SECTION HEADER
========================================================= */

.sk-section-header {
    display: flex;

    align-items: center;
    justify-content: space-between;

    padding: 24px;
}

.sk-section-title {
    margin: 0 0 5px;

    font-size: 20px;
    font-weight: 600;

    color: #204b7d;
}

.sk-section-description {
    margin: 0;

    font-size: 13px;

    color: #9aa7b8;
}


/* =========================================================
   ADD BUTTON
========================================================= */

.sk-add-button {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 8px;

    height: 42px;

    padding: 0 20px;

    border: 0;
    border-radius: 22px;

    background: #2878d7;

    color: #fff;

    font-size: 14px;
    font-weight: 500;

    cursor: pointer;

    transition: .2s ease;
}

.sk-add-button:hover {
    background: #216bc4;

    color: #fff;
}

.sk-add-button i {
    font-size: 16px;
}


/* =========================================================
   TABLE CARD
========================================================= */

.sk-card {
    margin: 0 24px 24px;

    padding: 16px;

    background: #fff;

    border: 1px solid #e5e9ee;

    border-radius: 8px;
}


/* =========================================================
   TOOLBAR
========================================================= */

.sk-table-toolbar {
    min-height: 42px;

    display: flex;

    align-items: center;
    justify-content: space-between;

    padding-bottom: 12px;
}

.sk-show {
    display: flex;

    align-items: center;

    gap: 5px;

    color: #73829a;

    font-size: 13px;
}

.sk-select {
    width: 50px;
    height: 28px;

    padding: 2px 5px;

    border: 1px solid #aab6c8;
    border-radius: 4px;

    background: #fff;

    color: #53667e;

    font-size: 12px;

    outline: none;
}

.sk-search {
    width: 160px;
    height: 30px;

    display: flex;

    align-items: center;

    padding: 0 8px;

    border: 1px solid #9aabc0;
    border-radius: 4px;

    background: #fff;

    color: #31577f;
}

.sk-search i {
    font-size: 12px;
}

.sk-search input {
    width: 100%;

    padding-left: 7px;

    border: 0;
    outline: 0;

    background: transparent;

    font-size: 11px;
}

.sk-search input::placeholder {
    color: #8997a9;
}


/* =========================================================
   TABLE
========================================================= */

.sk-table-wrapper {
    width: 100%;

    overflow-x: auto;
}

.sk-table {
    width: 100%;

    min-width: 1100px;

    border-collapse: collapse;

    table-layout: fixed;

    color: #4c6380;

    font-size: 13px;
}

.sk-table thead {
    background: #f6f8fa;
}

.sk-table th {
    height: 48px;

    padding: 8px 10px;

    border-bottom: 1px solid #dfe4ea;

    color: #365a82;

    font-size: 12px;
    font-weight: 600;

    vertical-align: middle;

    white-space: nowrap;
}

.sk-table th span {
    display: block;

    margin-top: 3px;

    color: #777f87;

    font-size: 11px;
    font-weight: 400;
}

.sk-table td {
    min-height: 60px;

    padding: 10px;

    border-bottom: 1px solid #e4e8ed;

    color: #4c6380;

    vertical-align: middle;
}

.sk-table tbody tr:last-child td {
    border-bottom: 0;
}


/* =========================================================
   COLUMN WIDTH
========================================================= */

.sk-table th:nth-child(1),
.sk-table td:nth-child(1) {
    width: 50px;

    text-align: center;
}

.sk-table th:nth-child(2),
.sk-table td:nth-child(2) {
    width: 165px;
}

.sk-table th:nth-child(3),
.sk-table td:nth-child(3) {
    width: 190px;
}

.sk-table th:nth-child(4),
.sk-table td:nth-child(4) {
    width: 120px;
}

.sk-table th:nth-child(5),
.sk-table td:nth-child(5) {
    width: 145px;
}

.sk-table th:nth-child(6),
.sk-table td:nth-child(6) {
    width: 190px;
}

.sk-table th:nth-child(7),
.sk-table td:nth-child(7) {
    width: 140px;
}

.sk-table th:nth-child(8),
.sk-table td:nth-child(8) {
    width: 150px;
}


/* =========================================================
   NO SK
========================================================= */

.sk-number {
    font-weight: 600;

    color: #204b7d;

    white-space: nowrap;
}

.sk-previous {
    margin-top: 4px;

    color: #8a96a6;

    font-size: 11px;

    white-space: nowrap;
}


/* =========================================================
   STATUS
========================================================= */

.sk-status {
    display: flex;

    align-items: center;

    gap: 5px;

    white-space: nowrap;
}

.status-active,
.status-inactive {
    display: inline-flex;

    align-items: center;

    gap: 4px;

    font-size: 13px;
    font-weight: 500;
}

.status-active {
    color: #198754;
}

.status-inactive {
    color: #777f87;
}

.status-active i,
.status-inactive i {
    font-size: 14px;
}


/* =========================================================
   APPROVAL
========================================================= */

.approval {
    display: inline-flex;

    align-items: center;

    gap: 5px;

    white-space: nowrap;

    font-size: 12px;
}

.approval i {
    font-size: 14px;
}

.approval.approved {
    color: #198754;
}

.approval.pending {
    color: #f5a900;
}

.approval.disabled {
    color: #a7b1be;
}


/* =========================================================
   CONFIRMATION
========================================================= */

.sk-confirmation {
    display: flex;

    align-items: center;
    justify-content: center;

    gap: 4px;
}


/* =========================================================
   ICON BUTTON
========================================================= */

.sk-icon-btn {
    width: 30px;
    height: 30px;

    display: inline-flex;

    align-items: center;
    justify-content: center;

    padding: 0;

    border: 0;

    border-radius: 50%;

    background: transparent;

    cursor: pointer;

    font-size: 14px;

    transition: .15s ease;
}

.sk-icon-btn:hover {
    background: #f1f4f8;
}

.sk-icon-btn.edit {
    color: #2878d7;
}

.sk-icon-btn.view {
    color: #198754;
}

.sk-icon-btn.success {
    color: #198754;
}

.sk-icon-btn.confirm {
    color: #f5a900;
}

.sk-icon-btn.clock {
    color: #f5a900;
}

.sk-icon-btn.pdf {
    color: #dc3545;
}

.sk-icon-btn.delete {
    color: #dc3545;
}


/* =========================================================
   ACTIONS
========================================================= */

.sk-actions {
    display: flex;

    align-items: center;
    justify-content: center;

    gap: 3px;
}


/* =========================================================
   EMPTY
========================================================= */

.sk-empty {
    padding: 40px 20px;

    color: #8995a5;

    text-align: center;
}

.sk-empty i {
    display: block;

    margin-bottom: 10px;

    font-size: 32px;
}


/* =========================================================
   PAGINATION
========================================================= */

.sk-pagination {
    display: flex;

    align-items: center;
    justify-content: center;

    gap: 5px;

    margin-top: 18px;
}

.sk-pagination button {
    width: 32px;
    height: 30px;

    display: inline-flex;

    align-items: center;
    justify-content: center;

    padding: 0;

    border: 1px solid #dce2ea;
    border-radius: 5px;

    background: #fff;

    color: #527092;

    font-size: 12px;

    cursor: pointer;
}

.sk-pagination button:hover:not(.active) {
    background: #f4f7fa;
}

.sk-pagination button.active {
    border-color: #2878d7;

    background: #2878d7;

    color: #fff;
}


/* =========================================================
   MODAL
========================================================= */

.modal-description {
    color: #9aa7b8;

    font-size: 13px;
}

.form-label-custom {
    display: block;

    margin-bottom: 7px;

    color: #365a82;

    font-size: 13px;
    font-weight: 500;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 768px) {

    .sk-section-header {
        flex-direction: column;

        align-items: flex-start;

        gap: 15px;
    }

    .sk-add-button {
        align-self: flex-end;
    }

    .sk-table-toolbar {
        flex-direction: column;

        align-items: flex-start;

        gap: 10px;
    }

    .sk-search {
        width: 100%;
    }

    .sk-card {
        margin-left: 12px;
        margin-right: 12px;
    }

    .sk-organization-header {
        padding-left: 15px;
        padding-right: 15px;
    }

}

</style>