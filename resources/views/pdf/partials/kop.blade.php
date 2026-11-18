@php
    $jabatanKop = mb_strtoupper($kop->nama_jabatan ?: $kop->nama_unit);
    $logoSrc = $logoSk ?: ($logo ?? null);

    if (empty($logoSrc)) {
        $logoSrc = public_path('images/logobatam.jpg');
    }
@endphp

<table width="100%" style="border-collapse:collapse; table-layout:fixed;">
    <tr>
        {{-- kolom kiri & kanan SAMA lebar supaya teks tepat di tengah halaman --}}
        <td width="18%" align="left" valign="middle" style="padding-left:4px;">
            @if ($logoSrc)
                <img src="{{ $logoSrc }}" style="display:block; width:auto; height:92px; max-width:92px; object-fit:contain;">
            @endif
        </td>

        <td width="64%" align="center" valign="middle" style="font-family:Arial, sans-serif; padding-left:8px; padding-right:8px;">
            <div style="font-size:14pt; line-height:1.15;">PEMERINTAH KOTA BATAM</div>
            <div style="font-size:16pt; font-weight:bold; line-height:1.15; margin:2px 0 4px;">{{ $jabatanKop }}</div>
            <div style="font-size:9pt; line-height:1.3;">{{ $kop->alamat }}</div>
            <div style="font-size:9pt; line-height:1.3;">Telp. {{ $kop->telepon }} &nbsp; Email : {{ $kop->email }}</div>
            <div style="font-size:9pt; line-height:1.3;">Laman {{ $kop->website }}</div>
        </td>

        <td width="18%"></td>
    </tr>
</table>

{{-- garis ganda: tebal di atas, tipis di bawah --}}
<div style="border-top:3px solid #000; border-bottom:1px solid #000; height:2px; margin:6px 0 14px;"></div>