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
                <label class="auth-label"><i class="bi bi-person-fill"></i> Username:</label>
                <div class="auth-input-group">
                    <i class="bi bi-person"></i>
                    <input type="text" name="username" class="auth-input" placeholder="Masukan Email Pengguna" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="auth-label"><i class="bi bi-lock-fill"></i> Kata Sandi:</label>
                <div class="auth-input-group">
                    <i class="bi bi-lock"></i>
                        <input type="password" name="password" id="passwordInput" class="auth-input" placeholder="Masukan Kata Sandi" required>
                    <button type="button" class="auth-toggle-password" id="togglePassword" aria-label="Tampilkan kata sandi">
                         <i class="bi bi-eye-slash" id="toggleIcon"></i>
                    </button>
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
@push('scripts')
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const input = document.getElementById('passwordInput');
        const icon = document.getElementById('toggleIcon');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        } else {
            input.type = 'password';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        }
    });
</script>
@endpush
@endsection