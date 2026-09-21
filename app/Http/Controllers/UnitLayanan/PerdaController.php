<?php

namespace App\Http\Controllers\UnitLayanan;

use App\Http\Controllers\Controller;
use App\Models\Perda;
use App\Traits\ResolvesInstansiId;
use Illuminate\Http\Request;

class PerdaController extends Controller
{
    use ResolvesInstansiId;

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tentang' => ['required', 'string'],
        ]);

        Perda::create([
            'id_instansi' => $this->currentInstansiId(),
            'tentang'     => $validated['tentang'],
        ]);

        return redirect()
            ->route('unit_layanan.profile.regulations')
            ->with('success_modal', 'Peraturan Daerah berhasil ditambahkan.');
    }

    public function update(Request $request, Perda $perda)
    {
        $validated = $request->validate([
            'tentang' => ['required', 'string'],
        ]);

        $perda->update($validated);

        return redirect()
            ->route('unit_layanan.profile.regulations')
            ->with('success_modal', 'Peraturan Daerah berhasil diperbarui.');
    }

    public function destroy(Perda $perda)
    {
        $perda->delete();

        return redirect()
            ->route('unit_layanan.profile.regulations')
            ->with('success_modal', 'Peraturan Daerah berhasil dihapus.');
    }
}