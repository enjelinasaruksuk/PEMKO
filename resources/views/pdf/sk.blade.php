@php
    $jabatan = mb_strtoupper($kop->nama_jabatan ?: $kop->nama_unit);
    $unitUpper = mb_strtoupper($namaUnit);
    $clean = fn ($html) => strip_tags($html ?? '', '<p><br><ul><ol><li><strong><b><em><i><u>');

    $komponenPenyampaian = \App\Models\KomponenPelayanan::where('kategori', 'Penyampaian')
    ->orderBy('id_komponen')->get();
    $komponenPengelolaan = \App\Models\KomponenPelayanan::where('kategori', 'Pengelolaan')
    ->orderBy('id_komponen')->get();

    $mengingat = [
        'Undang-Undang Nomor 53 Tahun 1999 tentang Pembentukan Kabupaten Pelalawan, Kabupaten Rokan Hulu, Kabupaten Rokan Hilir, Kabupaten Siak, Kabupaten Karimun, Kabupaten Natuna, Kabupaten Kuantan Singingi, dan Kota Batam (Lembaran Negara Republik Indonesia Tahun 1999 Nomor 181, Tambahan Lembaran Negara Republik Indonesia Nomor 3902) sebagaimana telah beberapa kali diubah terakhir dengan Undang-Undang Nomor 34 Tahun 2008 tentang Perubahan Ketiga atas Undang-Undang Nomor 53 Tahun 1999 tentang Pembentukan Kabupaten Pelalawan, Kabupaten Rokan Hulu, Kabupaten Rokan Hilir, Kabupaten Siak, Kabupaten Karimun, Kabupaten Natuna, Kabupaten Kuantan Singingi, dan Kota Batam (Lembaran Negara Republik Indonesia Tahun 2008 Nomor 107, Tambahan Lembaran Negara Republik Indonesia Nomor 4880)',
        'Undang-Undang Nomor 25 Tahun 2009 tentang Pelayanan Publik (Lembaran Negara Republik Indonesia Tahun 2009 Nomor 112, Tambahan Lembaran Negara Republik Indonesia Nomor 5038)',
        'Undang-Undang Nomor 23 Tahun 2014 tentang Pemerintahan Daerah (Lembaran Negara Republik Indonesia Tahun 2014 Nomor 244, Tambahan Lembaran Negara Republik Indonesia Nomor 5587) sebagaimana telah beberapa kali diubah terakhir dengan Undang-Undang Nomor 6 Tahun 2023 tentang Penetapan Peraturan Pemerintah Pengganti Undang-Undang Nomor 2 Tahun 2022 tentang Cipta Kerja menjadi Undang-Undang (Lembaran Negara Republik Indonesia Tahun 2023 Nomor 41, Tambahan Lembaran Negara Republik Indonesia Nomor 6856)',
        'Peraturan Pemerintah Nomor 18 Tahun 2016 tentang Perangkat Daerah (Lembaran Negara Republik Indonesia Tahun 2016 Nomor 114, Tambahan Lembaran Negara Republik Indonesia Nomor 5888)',
        'Peraturan Pemerintah Nomor 17 Tahun 2018 tentang Kecamatan (Lembaran Negara Republik Indonesia Tahun 2018 Nomor 73, Tambahan Lembaran Negara Republik Indonesia Nomor 6206)',
        'Peraturan Menteri Aparatur Sipil Negara dan Reformasi Birokrasi Nomor 15 Tahun 2014 tentang Pedoman Standar Pelayanan (Berita Negara Republik Indonesia Tahun 2014 Nomor 615)',
        'Peraturan Menteri Dalam Negeri Nomor 80 Tahun 2015 tentang Pembentukan Produk Hukum Daerah (Berita Negara Republik Indonesia Tahun 2015 Nomor 2036) sebagaimana telah diubah dengan Peraturan Menteri Dalam Negeri Nomor 120 Tahun 2018 tentang Perubahan atas Peraturan Menteri Dalam Negeri Nomor 80 Tahun 2015 tentang Pembentukan Produk Hukum Daerah (Berita Negara Republik Indonesia Tahun 2018 Nomor 157)',
    ];
    foreach ($perdaList as $p)   { $mengingat[] = $p->tentang; }
    foreach ($perwaliList as $p) { $mengingat[] = $p->tentang; }
@endphp
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
    @page { margin: 2cm 2.5cm; }
    body { font-family: "Times", serif; font-size: 12pt; line-height: 1.3; }
    .c { text-align:center; font-weight:bold; }
    .j { text-align: justify; }
    td { vertical-align: top; }
    .tbl { border-collapse: collapse; width:100%; }
    .tbl th { background:#9dc3e6; border:1px solid #bbb; padding:6px; }
    .tbl td { border:1px solid #ccc; padding:6px 8px; }
    .tbl tr { page-break-inside: avoid; }
    .tbl thead { display: table-header-group; }
    .grp { font-weight:bold; }
    .sk { border-collapse:collapse; border-spacing:0; width:100%; }
    .sk td { vertical-align:top; padding:0 0 6px 0; line-height:1.3; }
    .sk table td { padding:0 0 2px 0; }
    .uraian p, .uraian ul, .uraian ol { margin:0 0 4px 0; padding:0; }
    .uraian ul, .uraian ol { padding-left:16px; }
</style>
</head>
<body>

@include('pdf.partials.kop')

<div class="c">
    KEPUTUSAN {{ $jabatan }} KOTA BATAM<br>
    NOMOR : {{ $sk->no_sk }}<br><br>
    TENTANG<br><br>
    STANDAR PELAYANAN {{ $unitUpper }}<br>
    KOTA BATAM<br><br>
    {{ $jabatan }} KOTA BATAM
</div>

<br>
{{-- Menimbang + Mengingat: satu tabel datar (3 kolom) supaya daftar panjang bisa pindah halaman --}}
<table class="sk">
    <tr>
        <td width="95"><b>Menimbang :</b></td>
        <td width="22">a.</td>
        <td class="j">bahwa dalam rangka mewujudkan penyelenggaraan pelayanan publik sesuai dengan asas penyelenggaraan pemerintahan yang baik dan guna mewujudkan penyelenggaraan pelayanan yang cepat, mudah dan berkualitas;</td>
    </tr>
    <tr>
        <td></td><td>b.</td>
        <td class="j">bahwa untuk memberikan pedoman penyeragaman dalam penyelenggaraan pelayanan pada {{ $namaUnit }} perlu ditetapkan standar pelayanan {{ $namaUnit }} di Lingkungan Pemerintah Kota Batam;</td>
    </tr>
    <tr>
        <td></td><td>c.</td>
        <td class="j">bahwa berdasarkan pertimbangan sebagaimana dimaksud dalam huruf a dan huruf b, perlu menetapkan Keputusan {{ $kop->nama_jabatan ?: $kop->nama_unit }} tentang Standar Pelayanan {{ $namaUnit }} di Lingkungan Pemerintah Kota Batam;</td>
    </tr>
    @foreach ($mengingat as $i => $teks)
    <tr>
        <td>@if ($loop->first)<b>Mengingat :</b>@endif</td>
        <td>{{ $i + 1 }}.</td>
        <td class="j">{{ $teks }}{{ $loop->last ? '.' : ';' }}</td>
    </tr>
    @endforeach
</table>

<div class="c" style="margin:10px 0 10px;">MEMUTUSKAN :</div>

@php
    $adaPencabutan = $sk->jenis_sk === 'Menggantikan SK Sebelumnya' && $sk->no_sk_sebelumnya;
@endphp
<table class="sk">
    <tr>
        <td width="100"><b>Menetapkan :</b></td>
        <td class="j">STANDAR PELAYANAN {{ $unitUpper }} DI LINGKUNGAN PEMERINTAH KOTA BATAM.</td>
    </tr>
    <tr>
        <td><b>KESATU :</b></td>
        <td class="j">Standar Pelayanan {{ $namaUnit }} sebagaimana tercantum dalam Lampiran Keputusan ini.</td>
    </tr>
    <tr>
        <td><b>KEDUA :</b></td>
        <td class="j">Standar pelayanan yang dimaksud pada DIKTUM KESATU mempunyai komponen standar pelayanan sebagaimana diatur dalam Undang-Undang Nomor 25 Tahun 2009, dalam peraturan tersebut komponen standar pelayanan dibedakan menjadi 2 bagian.</td>
    </tr>
    <tr>
        <td><b>KETIGA :</b></td>
        <td>
            <div class="j" style="margin-bottom:2px;">Komponen standar pelayanan sebagaimana dimaksud pada DIKTUM KEDUA, sebagai berikut:</div>
            <table class="sk" width="100%">
                <tr>
                    <td width="22">1.</td>
                    <td class="j">Komponen standar pelayanan yang terkait dengan proses penyampaian (<i>Service point</i>) meliputi;
                        <table class="sk" width="100%">
                            @foreach (['Persyaratan', 'Sistem, mekanisme, dan prosedur', 'Jangka waktu pelayanan', 'Biaya/tarif', 'Produk pelayanan', 'Penanganan pengaduan, saran dan masukan/apresiasi'] as $teks)
                            <tr><td width="22">{{ chr(97 + $loop->index) }}.</td><td class="j">{{ $teks }}</td></tr>
                            @endforeach
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td class="j">Komponen standar pelayanan yang terkait dengan proses pengelolaan pelayanan (<i>Manufacturing</i>) meliputi;
                        <table class="sk" width="100%">
                            @foreach (['Dasar hukum', 'Sarana dan prasarana', 'Kompetensi pelaksana', 'Pengawasan internal', 'Jumlah pelaksana', 'Jaminan pelaksana', 'Jaminan keamanan dan keselamatan pelayanan', 'Evaluasi kinerja pelaksana'] as $teks)
                            <tr><td width="22">{{ chr(97 + $loop->index) }}.</td><td class="j">{{ $teks }}{{ $loop->last ? '.' : '' }}</td></tr>
                            @endforeach
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td><b>KEEMPAT :</b></td>
        <td>
            <div class="j" style="margin-bottom:2px;">Jenis standar pelayanan yang ada di {{ $namaUnit }} di Lingkungan Pemerintah Kota Batam, sebagai berikut:</div>
            <table class="sk" width="100%">
                @forelse ($layananList as $i => $l)
                <tr><td width="22">{{ $i + 1 }}.</td><td class="j">{{ mb_strtoupper($l->nama_layanan) }}</td></tr>
                @empty
                <tr><td colspan="2"><i>(belum ada layanan yang diinput)</i></td></tr>
                @endforelse
            </table>
        </td>
    </tr>
    <tr>
        <td><b>KELIMA :</b></td>
        <td class="j">Bentuk/Format Surat sebagaimana dimaksud pada DIKTUM KEEMPAT sesuai dengan format pada lampiran atau peraturan perundang-undangan yang berlaku.</td>
    </tr>
    @if ($adaPencabutan)
    <tr>
        <td><b>KEENAM :</b></td>
        <td class="j">Pada saat Keputusan ini mulai berlaku, Keputusan {{ $jabatan }} Kota Batam Nomor {{ $sk->no_sk_sebelumnya }} dicabut dan dinyatakan tidak berlaku.</td>
    </tr>
    @endif
    <tr>
        <td><b>{{ $adaPencabutan ? 'KETUJUH' : 'KEENAM' }} :</b></td>
        <td class="j">Keputusan ini mulai berlaku pada tanggal ditetapkan.</td>
    </tr>
</table>

@include('pdf.partials.ttd')

{{-- ============ LAMPIRAN PER LAYANAN ============ --}}
@foreach ($layananList as $i => $l)
<div style="page-break-before: always;">
    <table width="100%" style="border-collapse:collapse; table-layout:fixed;">
        <tr>
            <td width="48%"></td>
            <td width="52%" align="left" valign="top">
                <div style="font-weight:bold; margin-bottom:4px;">LAMPIRAN : KEPUTUSAN {{ $jabatan }}</div>
                <table style="font-size:11pt; border-collapse:collapse; line-height:1.25;">
                    <tr>
                        <td width="62">NOMOR</td>
                        <td width="8">:</td>
                        <td>{{ $sk->no_sk }}</td>
                    </tr>
                    <tr>
                        <td>TENTANG</td>
                        <td>:</td>
                        <td>STANDAR PELAYANAN (SP)<br>{{ mb_strtoupper($l->nama_layanan) }}<br>KOTA BATAM TAHUN {{ $sk->tanggal_sk->format('Y') }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <div class="c">STANDAR PELAYANAN (SP)<br>{{ mb_strtoupper($l->nama_layanan) }}</div>
    <br>

        @php($komponenMap = $l->komponenMap())
    <table class="tbl">
        <thead>
            <tr><th width="30">NO</th><th width="150">KOMPONEN</th><th>URAIAN</th></tr>
        </thead>
        <tbody>

        <tr><td colspan="3" class="grp">PENYAMPAIAN LAYANAN</td></tr>
        @foreach ($komponenPenyampaian as $komponen)
        <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td>{{ $komponen->nama_komponen }}</td>
            <td class="uraian">{!! $clean($komponenMap[$komponen->id_komponen] ?? '') !!}</td>
        </tr>
        @endforeach

        <tr><td colspan="3" class="grp">PENGELOLAAN PELAYANAN</td></tr>
        @foreach ($komponenPengelolaan as $komponen)
        <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td>{{ $komponen->nama_komponen }}</td>
            <td class="uraian">{!! $clean($komponenMap[$komponen->id_komponen] ?? '') !!}</td>
        </tr>
        @endforeach
        </tbody>
    </table>

    @include('pdf.partials.ttd')
</div>
@endforeach

</body>
</html>