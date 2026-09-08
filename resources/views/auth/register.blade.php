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
                <option value="1">Instansi Level 1</option>
                <option value="2">Instansi Level 2</option>
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
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3 d-none" id="wrapperLevel2">
            <label class="auth-reg-label">Instansi Level 2</label>
            <select name="instansi_level_2" class="auth-reg-select">
                <option value="" selected disabled>Pilih Instansi Level 2</option>
                @foreach ($instansiLevel2 ?? [] as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="auth-reg-label">Email Instansi</label>
            <input type="email" name="email" class="auth-reg-input" placeholder="Masukan Email Instansi" required>
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
    document.getElementById('levelAkun').addEventListener('change', function () {
        const wrapperLevel2 = document.getElementById('wrapperLevel2');
        wrapperLevel2.classList.toggle('d-none', this.value !== '2');
    });
</script>
@endpush