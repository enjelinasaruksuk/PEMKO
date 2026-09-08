@extends('layouts.auth')
@section('title', 'Login')

@section('content')
<div class="auth-content">

    {{-- LOGO --}}
    <div class="auth-logo-side">
        <img src="{{ asset('images/logo_login_asap.png') }}" alt="ASAP" class="auth-logo-img"
             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
        <div class="auth-logo-placeholder" style="display:none;">
            <span class="auth-logo-text">ASAP</span>
            <span class="auth-logo-subtitle">Aplikasi Standar Administrasi Pelayanan</span>
        </div>
    </div>

    {{-- FORM --}}
    <div class="auth-form-side">

        <p class="auth-form-title">Isi Nama Pengguna dan Kata Sandi Anda dengan benar!</p>

        <form action="{{ Route::has('login.submit') ? route('login.submit') : '#' }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="auth-label"><i class="bi bi-person-fill"></i> Email Pengguna:</label>
                <div class="auth-input-group">
                    <i class="bi bi-person"></i>
                    <input type="email" name="email" class="auth-input" placeholder="Masukan Email Pengguna" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="auth-label"><i class="bi bi-lock-fill"></i> Kata Sandi:</label>
                <div class="auth-input-group">
                    <i class="bi bi-lock"></i>
                    <input type="password" name="password" class="auth-input" placeholder="Masukan Kata Sandi" required>
                </div>
            </div>

            <p class="auth-register-text">
                Belum punya akun?
                <a href="{{ Route::has('register') ? route('register') : '#' }}">Ajukan akun baru.</a>
            </p>

            <div class="text-center">
                <button type="submit" class="auth-submit-btn">Masuk</button>
            </div>

        </form>

    </div>

</div>
@endsection