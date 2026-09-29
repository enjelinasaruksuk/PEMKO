@php $jabatanKop = mb_strtoupper($kop->nama_jabatan ?: $kop->nama_unit); @endphp
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