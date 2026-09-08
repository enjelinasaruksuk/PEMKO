document.addEventListener('DOMContentLoaded', function () {

    /* =====================================================
       SIDEBAR TOGGLE
    ====================================================== */

    const toggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.unit-sidebar');
    const logoArea = document.getElementById('logoArea');

    if (toggle && sidebar) {
        toggle.addEventListener('click', function () {
            sidebar.classList.toggle('collapsed');
            if (logoArea) {
                logoArea.classList.toggle('collapsed');
            }
        });
    }


    /* =====================================================
       DELETE CONFIRMATION MODAL
    ====================================================== */

    const deleteModal = document.getElementById('deleteConfirmModal');
    const deleteForm = document.getElementById('deleteConfirmForm');

    if (deleteModal && deleteForm) {
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            if (!button) {
                return;
            }

            const action = button.getAttribute('data-delete-action');
            if (action) {
                deleteForm.setAttribute('action', action);
            }
        });
    }


    /* =====================================================
       RICH TEXT EDITOR
    ====================================================== */

    const editors = document.querySelectorAll('[data-rich-editor]');

    editors.forEach(function (editorWrapper) {

        const editor = editorWrapper.querySelector('.rich-editor');
        const hiddenInput = editorWrapper.querySelector('textarea[data-rich-value]');
        const toolbarButtons = editorWrapper.querySelectorAll('[data-command]');

        if (!editor) {
            return;
        }

        // Load existing content
        if (hiddenInput && hiddenInput.value.trim() !== '') {
            editor.innerHTML = hiddenInput.value;
        }

        // Toolbar command
        toolbarButtons.forEach(function (button) {

            button.addEventListener('mousedown', function (event) {
                // Mencegah editor kehilangan selection ketika tombol toolbar diklik.
                event.preventDefault();
            });

            button.addEventListener('click', function () {

                const command = button.getAttribute('data-command');
                const value = button.getAttribute('data-value');

                editor.focus();

                if (command === 'formatBlock') {
                    document.execCommand(command, false, value || 'p');
                } else {
                    document.execCommand(command, false, value || null);
                }

                updateEditorValue();
                updateToolbarState();
            });

        });

        function updateEditorValue() {
            if (hiddenInput) {
                hiddenInput.value = editor.innerHTML;
            }
        }

        function updateToolbarState() {
            toolbarButtons.forEach(function (button) {

                const command = button.getAttribute('data-command');

                if (
                    command === 'bold' ||
                    command === 'italic' ||
                    command === 'underline' ||
                    command === 'insertUnorderedList' ||
                    command === 'insertOrderedList'
                ) {
                    try {
                        const active = document.queryCommandState(command);
                        button.classList.toggle('active', active);
                    } catch (error) {
                        // Abaikan command yang tidak didukung browser.
                    }
                }

            });
        }

        editor.addEventListener('input', function () {
            updateEditorValue();
        });

        editor.addEventListener('keyup', function () {
            updateEditorValue();
            updateToolbarState();
        });

        editor.addEventListener('mouseup', function () {
            updateToolbarState();
        });

        editor.addEventListener('paste', function () {
            setTimeout(function () {
                updateEditorValue();
            }, 0);
        });

    });


    /* =====================================================
       FORM SUBMIT
       Pastikan semua rich text sudah masuk textarea.
    ====================================================== */

    document.querySelectorAll('form').forEach(function (form) {
        form.addEventListener('submit', function () {
            form.querySelectorAll('[data-rich-editor]').forEach(function (editorWrapper) {

                const editor = editorWrapper.querySelector('.rich-editor');
                const hiddenInput = editorWrapper.querySelector('textarea[data-rich-value]');

                if (editor && hiddenInput) {
                    hiddenInput.value = editor.innerHTML;
                }

            });
        });
    });

});