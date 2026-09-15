<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: Arial, sans-serif; color: #173b69;">
    <h2 style="color: #163f73;">Akun Anda Telah Disetujui</h2>

    <p>Halo <strong>{{ $pengguna->nama_pengguna }}</strong>,</p>

    <p>Pengajuan akun Anda di aplikasi ASAP (Standar Pelayanan Pemerintah Kota Batam) telah disetujui. Berikut kredensial login Anda:</p>

    <table style="margin: 16px 0;">
        <tr>
            <td style="padding: 4px 12px 4px 0;">Username</td>
            <td><strong>{{ $pengguna->username }}</strong></td>
        </tr>
        <tr>
            <td style="padding: 4px 12px 4px 0;">Password</td>
            <td><strong>{{ $passwordPlain }}</strong></td>
        </tr>
    </table>

    <p>Silakan login melalui: <a href="{{ route('login') }}">{{ route('login') }}</a></p>

    <p style="color: #6c7a8f; font-size: 13px;">Demi keamanan, segera ganti password Anda setelah login pertama kali.</p>
</body>
</html>