<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <style>
        @page { margin: 2cm 2.5cm; }
        body { font-family: "Times", serif; font-size: 12pt; line-height: 1.5; }
        .title { text-align: center; font-weight: bold; text-decoration: underline; margin: 28px 0; }
        .content { text-align: justify; }
        .signature { width: 45%; margin: 48px 0 0 auto; text-align: center; page-break-inside: avoid; }
    </style>
</head>
<body>
    @include('pdf.partials.kop')

    <div class="title">MAKLUMAT PELAYANAN PUBLIK</div>

    <p class="content">{{ $maklumat->isi_maklumat }}</p>

    <div class="signature">
        Ditetapkan di Batam<br>
        Pada tanggal {{ $maklumat->tanggal_input?->translatedFormat('d F Y') ?? now()->translatedFormat('d F Y') }}<br><br>
        <strong>{{ mb_strtoupper($kop->nama_jabatan ?: $kop->nama_unit) }},</strong>
        <div style="height:70px; margin:4px 0;">
            @if ($ttd)
            <img src="{{ $ttd }}" style="height:65px;" alt="Tanda tangan pejabat">
            @endif
        </div>
        <strong><u>{{ $namaPejabat }}</u></strong><br>
        {{ $kop->pangkat }}<br>
        NIP. {{ $nip ?: $kop->nip }}
    </div>
</body>
</html>
