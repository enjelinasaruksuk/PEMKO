@extends('layouts.auth')
@section('title', 'Pengajuan Akun')
@section('card-class', 'auth-register-card')

@section('content')
<div class="auth-register-content auth-register-page">

    <p class="auth-register-breadcrumb">Pengajuan Akun</p>

    <h2 class="auth-register-title">Ajukan Akun Baru</h2>
    <p class="auth-register-desc">Pengajuan diproses admin. Kredensial dikirim ke Email setelah disetujui.</p>

    <form action="{{ Route::has('register.submit') ? route('register.submit') : '#' }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="auth-reg-label">Level Akun</label>
            <select name="level_akun" id="levelAkun" class="auth-reg-select">
                <option value="1" {{ old('level_akun', '1') == '1' ? 'selected' : '' }}>Instansi Level 1</option>
                <option value="2" {{ old('level_akun') == '2' ? 'selected' : '' }}>Instansi Level 2</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="auth-reg-label">Instansi</label>
            <select class="auth-reg-select" disabled>
                <option>Pemerintahan Kota Batam</option>
            </select>
        </div>

        <div class="mb-3" id="wrapperLevel1">
            <label class="auth-reg-label">Instansi Level 1</label>
            <select name="instansi_level_1" class="auth-reg-select">
                <option value="" selected disabled>Pilih Instansi Level 1</option>
                @foreach ($instansiLevel1 ?? [] as $item)
                    <option value="{{ $item->id_instansi }}" {{ old('instansi_level_1') == $item->id_instansi ? 'selected' : '' }}>{{ $item->nama_instansi }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3 {{ old('level_akun') == '2' ? '' : 'd-none' }}" id="wrapperLevel2">
            <label class="auth-reg-label">Instansi Level 2</label>
            <select name="instansi_level_2" class="auth-reg-select">
                <option value="" selected disabled>Pilih Instansi Level 2</option>
                @foreach ($instansiLevel2 ?? [] as $item)
                    <option value="{{ $item->id_instansi }}" data-parent-id="{{ $item->id_instansi_induk }}" {{ old('instansi_level_2') == $item->id_instansi ? 'selected' : '' }}>{{ $item->nama_instansi }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="auth-reg-label">Email Instansi</label>
            <input type="email" name="email" class="auth-reg-input" value="{{ old('email') }}" placeholder="Masukan Email Instansi" required>
        </div>

        <div class="d-flex justify-content-end gap-2">
            <a href="{{ Route::has('login') ? route('login') : '#' }}" class="auth-reg-btn-cancel">Batal</a>
            <button type="submit" class="auth-reg-btn-submit">Kirim Pengajuan</button>
        </div>

    </form>

</div>
@endsection

@push('scripts')
<script>
    const levelAkun = document.getElementById('levelAkun');
    const level1Select = document.querySelector('[name="instansi_level_1"]');
    const level2Select = document.querySelector('[name="instansi_level_2"]');

    function filterLevel2() {
        const parentId = level1Select.value;
        let selectedVisible = false;

        Array.from(level2Select.options).forEach(function (option) {
            if (!option.value) return;
            option.hidden = option.dataset.parentId !== parentId;
            option.disabled = option.hidden;
            if (option.selected && !option.hidden) selectedVisible = true;
        });

        if (!selectedVisible) level2Select.value = '';
    }

    levelAkun.addEventListener('change', function () {
        const wrapperLevel2 = document.getElementById('wrapperLevel2');
        wrapperLevel2.classList.toggle('d-none', this.value !== '2');
    });

    level1Select.addEventListener('change', filterLevel2);
    filterLevel2();
</script>
@endpush