<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Maklumat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MaklumatController extends Controller
{
    public function index(): View
    {
        $maklumatList = Maklumat::with('instansi')
            ->orderByRaw("FIELD(status, 'pending', 'disetujui', 'ditolak')")
            ->latest('id')
            ->get();

        return view('pages.admin.maklumat.index', compact('maklumatList'));
    }

    public function update(Request $request, Maklumat $maklumat): RedirectResponse
    {
        $validated = $request->validate([
            'keputusan' => ['required', 'in:disetujui,ditolak'],
        ]);

        abort_unless($maklumat->status === 'pending', 422, 'Maklumat ini sudah diproses.');

        $maklumat->update(['status' => $validated['keputusan']]);

        // Hanya satu maklumat aktif per instansi: yang lama dibuang saat yang baru disetujui.
        if ($validated['keputusan'] === 'disetujui') {
            Maklumat::where('id_instansi', $maklumat->id_instansi)
                ->where('status', 'disetujui')
                ->where('id', '!=', $maklumat->id)
                ->delete();
        }

        return redirect()
            ->route('admin.maklumat.index')
            ->with('success', $validated['keputusan'] === 'disetujui'
                ? 'Maklumat disetujui.'
                : 'Maklumat ditolak.');
    }
}