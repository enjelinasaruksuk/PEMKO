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
            'tentang' => $validated['tentang'],
        ]);

        return redirect()
            ->route('unit_layanan.profile.regulations')
            ->with('success_modal', 'Peraturan Daerah berhasil ditambahkan.');
    }

    public function update(Request $request, Perda $perda)
    {
        $this->authorizeOwnership($perda);

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
        $this->authorizeOwnership($perda);

        $perda->delete();

        return redirect()
            ->route('unit_layanan.profile.regulations')
            ->with('success_modal', 'Peraturan Daerah berhasil dihapus.');
    }

    private function authorizeOwnership(Perda $perda): void
    {
        abort_unless(
            $perda->id_instansi === $this->currentInstansiId(),
            403,
            'Anda tidak memiliki akses ke peraturan ini.'
        );
    }
}
