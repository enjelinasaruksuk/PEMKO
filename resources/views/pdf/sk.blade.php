@php
    $jabatan = mb_strtoupper($kop->nama_jabatan ?: $kop->nama_unit);
    $unitUpper = mb_strtoupper($namaUnit);
    $clean = fn ($html) => strip_tags($html ?? '', '<p><br><ul><ol><li><strong><b><em><i><u>');

    $penyampaian = [
        'persyaratan' => 'Persyaratan',
        'sistem_mekanisme_prosedur' => 'Sistem, Mekanisme dan Prosedur',
        'jangka_waktu' => 'Jangka Waktu Pelayanan',
        'biaya' => 'Biaya',
        'produk_pelayanan' => 'Produk Pelayanan',
        'penanganan_pengaduan' => 'Penanganan, Pengaduan, Saran dan Masukan',
    ];
    $pengelolaan = [
        'dasar_hukum' => 'Dasar Hukum',
        'sarana_prasarana' => 'Sarana dan Prasarana dan/atau Fasilitas',
        'kompetensi_pelaksana' => 'Kompetensi Pelaksana',
        'pengawasan_internal' => 'Pengawasan Internal',
        'jumlah_pelaksana' => 'Jumlah Pelaksana',
        'jaminan_pelayanan' => 'Jaminan Pelayanan',
        'jaminan_keamanan' => 'Jaminan Keamanan dan Keselamatan Pelayanan',
        'evaluasi_kinerja' => 'Evaluasi Kinerja Pelaksana',
    ];
    $mengingat = [
        'Undang-Undang Republik Indonesia Nomor 25 Tahun 2009 tentang Pelayanan Publik',
        'Peraturan Pemerintah Nomor 96 Tahun 2012 tentang Pelaksanaan Undang-Undang Republik Indonesia Nomor 25 Tahun 2009 tentang Pelayanan Publik',
        'Peraturan Menteri Pendayagunaan Aparatur Negara dan Reformasi Birokrasi Nomor 15 Tahun 2014 tentang Pedoman Standar Pelayanan',
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
<table width="100%">
    <tr>
        <td width="95"><b>Menimbang :</b></td>
        <td width="20">a.</td>
        <td class="j">bahwa dalam rangka mewujudkan penyelenggaraan pelayanan publik sesuai dengan asas penyelenggaraan pemerintahan yang baik, dan guna mewujudkan kepastian hak dan kewajiban berbagai pihak yang terkait dengan penyelenggaraan pelayanan, setiap penyelenggara pelayanan publik wajib menetapkan standar pelayanan;</td>
    </tr>
    <tr>
        <td></td><td>b.</td>
        <td class="j">bahwa untuk memberikan acuan dalam penilaian ukuran kinerja dan kualitas penyelenggaraan pelayanan dimaksud huruf a, maka perlu ditetapkan standar pelayanan {{ $namaUnit }} dengan Keputusan {{ $kop->nama_jabatan ?: $kop->nama_unit }};</td>
    </tr>
    <tr><td colspan="3">&nbsp;</td></tr>
    <tr>
        <td><b>Mengingat :</b></td>
        <td colspan="2">
            <table width="100%">
                @foreach ($mengingat as $i => $teks)
                <tr>
                    <td width="20">{{ $i + 1 }}.</td>
                    <td class="j">{{ $teks }}{{ $loop->last ? '.' : ';' }}</td>
                </tr>
                @endforeach
            </table>
        </td>
    </tr>
</table>

<div class="c" style="margin:14px 0 8px;">MEMUTUSKAN</div>

<table width="100%">
    <tr><td colspan="2"><b>Menetapkan :</b></td></tr>
    <tr>
        <td width="100"><b>KESATU :</b></td>
        <td class="j">Standar Pelayanan pada {{ $namaUnit }}, sebagaimana tercantum dalam Keputusan ini;</td>
    </tr>
    <tr>
        <td><b>KEDUA :</b></td>
        <td>
            Standar pelayanan pada {{ $namaUnit }} meliputi :
            <table width="100%">
                @forelse ($layananList as $i => $l)
                <tr><td width="20">{{ $i + 1 }}.</td><td class="j">{{ mb_strtoupper($l->nama_layanan) }}</td></tr>
                @empty
                <tr><td colspan="2"><i>(belum ada layanan yang diinput)</i></td></tr>
                @endforelse
            </table>
        </td>
    </tr>
    <tr>
        <td><b>KETIGA :</b></td>
        <td class="j">Standar pelayanan sebagaimana tercantum dalam Lampiran yang merupakan bagian tidak terpisahkan dari Keputusan ini wajib dilaksanakan oleh penyelenggara/pelaksana dan menjadi acuan dalam penilaian kinerja pelayanan oleh pimpinan penyelenggara, aparat pengawasan, dan masyarakat;</td>
    </tr>
    @if ($sk->jenis_sk === 'Menggantikan SK Sebelumnya' && $sk->no_sk_sebelumnya)
    <tr>
        <td><b>KEEMPAT :</b></td>
        <td class="j">Pada saat Keputusan ini mulai berlaku, Keputusan {{ $jabatan }} Kota Batam Nomor {{ $sk->no_sk_sebelumnya }} dicabut dan dinyatakan tidak berlaku.</td>
    </tr>
    <tr>
        <td><b>KELIMA :</b></td>
        <td class="j">Keputusan ini mulai berlaku pada tanggal ditetapkan, dengan ketentuan akan diadakan perbaikan sebagaimana mestinya apabila kemudian terdapat kesalahan dalam Keputusan ini.</td>
    </tr>
    @else
    <tr>
        <td><b>KEEMPAT :</b></td>
        <td class="j">Keputusan ini mulai berlaku pada tanggal ditetapkan, dengan ketentuan akan diadakan perbaikan sebagaimana mestinya apabila kemudian terdapat kesalahan dalam Keputusan ini.</td>
    </tr>
    @endif
</table>

@include('pdf.partials.ttd')

{{-- ============ LAMPIRAN PER LAYANAN ============ --}}
@foreach ($layananList as $i => $l)
<div style="page-break-before: always;">
    <b>Lampiran {{ $i + 1 }}</b><br>
    <table style="font-size:11pt;">
        <tr><td>Nomor</td><td>: {{ $sk->no_sk }}</td></tr>
        <tr><td>Tanggal</td><td>: {{ $sk->tanggal_sk->translatedFormat('d F Y') }}</td></tr>
    </table>
    <br>
    <div class="c">STANDAR PELAYANAN (SP)<br>{{ mb_strtoupper($l->nama_layanan) }}</div>
    <br>

    <table class="tbl">
        <thead>
            <tr><th width="30">NO</th><th width="150">KOMPONEN</th><th>URAIAN</th></tr>
        </thead>
        <tbody>

        <tr><td colspan="3" class="grp">PENYAMPAIAN LAYANAN</td></tr>
        @foreach ($penyampaian as $field => $label)
        <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td>{{ $label }}</td>
            <td class="uraian">{!! $clean($l->$field) !!}</td>
        </tr>
        @endforeach

        <tr><td colspan="3" class="grp">PENGELOLAAN PELAYANAN</td></tr>
        @foreach ($pengelolaan as $field => $label)
        <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td>{{ $label }}</td>
            <td class="uraian">{!! $clean($l->$field) !!}</td>
        </tr>
        @endforeach
        </tbody>
    </table>

    @include('pdf.partials.ttd')
</div>
@endforeach

</body>
</html>