<?php

namespace App\Http\Controllers\Instansi;

use App\Http\Controllers\Controller;
use App\Models\Maklumat;
use App\Models\TandaTangan;
use App\Traits\ResolvesInstansiId;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaklumatController extends Controller
{
    use ResolvesInstansiId;

    public function index()
    {
        $idSaya = $this->currentInstansiId();

        $maklumat = Maklumat::with('instansi')
            ->where('id_instansi', $idSaya)
            ->where('status', 'disetujui')
            ->latest()
            ->first();
        $maklumatList = $maklumat ? collect([$maklumat]) : collect();

        return view('pages.instansi.maklumat.index', compact('maklumatList'));
    }

    
public function store(Request $request)
{
    $validated = $request->validate([
        'nama_penjabat_baru' => ['required', 'string', 'max:255'],
        'nip_penjabat_baru' => ['required', 'digits:18', 'exists:tanda_tangan,nip'],
    ]);

    // Spesimen tanda tangan disimpan di kolom gambar, bukan path.
    $tandaTangan = TandaTangan::findOrFail(
        $validated['nip_penjabat_baru']
    );

    if (empty($tandaTangan->gambar)) {
        return back()
            ->withErrors([
                'nip_penjabat_baru' =>
                    'Gambar spesimen tanda tangan untuk NIP tersebut belum tersedia.',
            ])
            ->withInput();
    }

    $idInstansi = $this->currentInstansiId();

    abort_if(
        Maklumat::where('id_instansi', $idInstansi)
            ->where('status', 'pending')
            ->exists(),
        422,
        'Masih ada pengajuan Maklumat yang menunggu persetujuan Admin.'
    );

    Maklumat::create([
        'id_instansi' => $idInstansi,
        'isi_maklumat' => Maklumat::ISI_STANDAR,
        'nama_penjabat' => $validated['nama_penjabat_baru'],
        'nip_penjabat' => $validated['nip_penjabat_baru'],
        'tanggal_input' => now(),
        'status' => 'pending',
    ]);

    return redirect()
        ->route('instansi.maklumat.index')
        ->with(
            'success',
            'Pengajuan Maklumat dikirim ke Admin untuk disetujui.'
        );
}

}
