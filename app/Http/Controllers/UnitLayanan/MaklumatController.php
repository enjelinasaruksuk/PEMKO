<?php

namespace App\Http\Controllers\UnitLayanan;

use App\Http\Controllers\Controller;
use App\Models\Maklumat;
use App\Traits\ResolvesInstansiId;
use Illuminate\Http\Request;

class MaklumatController extends Controller
{
    use ResolvesInstansiId;

    /**
     * Teks standar isi Maklumat.
     * Nama pejabat (ttd) disimpan terpisah di kolom nama_penjabat,
     * jadi teks ini tidak perlu diubah tiap ganti pejabat.
     */
    protected string $templateIsiMaklumat = 'Kami siap memberikan pelayanan sesuai dengan standar pelayanan, melakukan perbaikan secara terus menerus, dan apabila kami tidak memberikan pelayanan sesuai dengan standar pelayanan yang telah ditetapkan, kami siap menerima sanksi dan/atau memberikan kompensasi sesuai dengan peraturan perundang-undangan yang berlaku.';

    public function index()
    {
        $maklumatList = Maklumat::where('id_instansi', $this->currentInstansiId())
            ->latest()
            ->get();

        return view('pages.unit-layanan.maklumat.index', compact('maklumatList'));
    }

    /**
     * Ganti Pejabat = membuat Maklumat baru dengan nama pejabat (ttd) terbaru.
     * Data lama tetap tersimpan sebagai riwayat, tapi yang tampil di Profil
     * adalah yang paling baru (latest()).
     *
     * Nama pejabat bersifat opsional (nullable) — Maklumat tetap bisa
     * dibuat hanya dengan isi_maklumat saja, tanpa nama pejabat/ttd dulu.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_penjabat_baru' => ['nullable', 'string', 'max:255'],
        ]);

        Maklumat::create([
            'id_instansi'   => $this->currentInstansiId(),
            'isi_maklumat'  => $this->templateIsiMaklumat,
            'nama_penjabat' => $validated['nama_penjabat_baru'] ?? null,
            'tanggal_input' => now(),
            'status'        => 'disetujui',
        ]);

        return redirect()
            ->route('unit_layanan.maklumat.index')
            ->with('success', 'Data Maklumat berhasil disimpan.');
    }
}