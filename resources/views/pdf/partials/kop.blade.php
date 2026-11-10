@php $jabatanKop = mb_strtoupper($kop->nama_jabatan ?: $kop->nama_unit); @endphp
@if (!empty($logoSk))
    <table width="100%" style="border-collapse:collapse; border-bottom:1.5px solid #000; padding-bottom:6px; margin-bottom:14px;">
        <tr>
            <td width="30%" align="center" valign="middle">
                <img src="{{ $logoSk }}" width="80" style="display:block; margin:0 auto;">
            </td>
            <td width="76%" align="center" valign="middle" style="font-family:Arial, sans-serif; padding:0 6px 8px;">
                <div style="font-size:14pt; line-height:1.15;">PEMERINTAH KOTA BATAM</div>
                <div style="font-size:18pt; font-weight:bold; line-height:1.15; margin:2px 0 5px;">{{ $jabatanKop }}</div>
                <div style="font-size:9pt; line-height:1.3;">{{ $kop->alamat }}</div>
                <div style="font-size:9pt; line-height:1.3;">Telepon {{ $kop->telepon }}</div>
                <div style="font-size:9pt; line-height:1.3;">Laman {{ $kop->website }}, Pos-el: {{ $kop->email }}</div>
            </td>
            <td width="12%"></td>
        </tr>
    </table>
@else
    <table width="100%" style="border-bottom:1.5px solid #000; padding-bottom:6px; margin-bottom:14px;">
        <tr>
            <td width="90" align="center">
                @if (!empty($logo)) <img src="{{ $logo }}" width="75"> @endif
            </td>
            <td align="center" style="font-family:Arial, sans-serif;">
                <div style="font-size:15pt;">PEMERINTAH KOTA BATAM</div>
                <div style="font-size:19pt; font-weight:bold;">{{ $jabatanKop }}</div>
                <div style="font-size:10pt;">{{ $kop->alamat }}</div>
                <div style="font-size:10pt;">Telepon {{ $kop->telepon }}</div>
                <div style="font-size:10pt;">Laman {{ $kop->website }}, Pos-el: {{ $kop->email }}</div>
            </td>
        </tr>
    </table>
@endif