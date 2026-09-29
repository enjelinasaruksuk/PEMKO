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
        $tandaTangan = TandaTangan::findOrFail($validated['nip_penjabat_baru']);
        abort_unless(
            Storage::disk('local')->exists($tandaTangan->path),
            422,
            'File spesimen tanda tangan untuk NIP tersebut tidak ditemukan.'
        );

        $idInstansi = $this->currentInstansiId();
        $maklumat = Maklumat::where('id_instansi', $idInstansi)
            ->where('status', 'disetujui')
            ->latest()
            ->first();

        $data = [
            'isi_maklumat' => 'Kami siap memberikan pelayanan sesuai dengan standar pelayanan, melakukan perbaikan secara terus menerus, dan apabila kami tidak memberikan pelayanan sesuai dengan standar pelayanan yang telah ditetapkan, kami siap menerima sanksi dan/atau memberikan kompensasi sesuai dengan peraturan perundang-undangan yang berlaku.',
            'nama_penjabat' => $validated['nama_penjabat_baru'],
            'nip_penjabat' => $validated['nip_penjabat_baru'],
            'tanggal_input' => now(),
            'status' => 'disetujui',
        ];

        if ($maklumat) {
            $maklumat->update($data);
        } else {
            Maklumat::create([
                ...$data,
                'id_instansi' => $idInstansi,
            ]);
        }

        return redirect()
            ->route('instansi.maklumat.index')
            ->with('success', 'Penandatangan Maklumat berhasil diperbarui.');
    }
}
