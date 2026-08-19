<div class="rich-field mb-4">

    <label
        for="{{ $name }}"
        class="form-label-custom"
    >
        {{ $label }}
    </label>


    {{-- TOOLBAR --}}
    <div class="rich-toolbar">

        <button
            type="button"
            class="rich-btn"
            data-command="bold"
            title="Bold"
        >
            <strong>B</strong>
        </button>


        <button
            type="button"
            class="rich-btn"
            data-command="italic"
            title="Italic"
        >
            <em>I</em>
        </button>


        <button
            type="button"
            class="rich-btn"
            data-command="insertUnorderedList"
            title="Bullet"
        >
            <i class="bi bi-list-ul"></i>
        </button>


        <button
            type="button"
            class="rich-btn"
            data-command="insertOrderedList"
            title="Numbering"
        >
            <i class="bi bi-list-ol"></i>
        </button>


        <button
            type="button"
            class="rich-btn"
            data-command="formatBlock"
            data-value="p"
            title="Paragraf"
        >
            <i class="bi bi-text-paragraph"></i>
        </button>

    </div>


    {{-- EDITOR --}}
    <div
        id="editor-{{ $name }}"
        class="rich-editor"
        contenteditable="true"
    >{!! $value !!}</div>


    {{-- HIDDEN INPUT --}}
    <input
        type="hidden"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ $value }}"
    >

</div>