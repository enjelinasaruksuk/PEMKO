<table width="100%" style="margin-top:20px; page-break-inside:avoid;">
    <tr>
        <td width="50%"></td>
        <td align="center">
            Ditetapkan di Batam<br>
            Pada tanggal {{ $sk->tanggal_sk->translatedFormat('d F Y') }}<br><br>
            <b>{{ $sk->ttd_jabatan }},</b>

            <div style="height:70px; margin:4px 0;">
                @if (!empty($ttd)) <img src="{{ $ttd }}" style="height:65px;"> @endif
            </div>

            <b><u>{{ $sk->ttd_nama }}</u></b><br>
            <b>{{ $sk->ttd_pangkat }}</b><br>
            <b>NIP. {{ $sk->ttd_nip }}</b>
        </td>
    </tr>
</table>