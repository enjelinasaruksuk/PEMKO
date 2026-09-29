<?php

namespace App\Http\Controllers\UnitLayanan;

use App\Http\Controllers\Controller;
use App\Models\Perwali;
use App\Traits\ResolvesInstansiId;
use Illuminate\Http\Request;

class PerwaliController extends Controller
{
    use ResolvesInstansiId;

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tentang' => ['required', 'string'],
        ]);

        Perwali::create([
            'id_instansi' => $this->currentInstansiId(),
            'tentang' => $validated['tentang'],
        ]);

        return redirect()
            ->route('unit_layanan.profile.regulations')
            ->with('success_modal', 'Peraturan Wali Kota berhasil ditambahkan.');
    }

    public function update(Request $request, Perwali $perwali)
    {
        $this->authorizeOwnership($perwali);

        $validated = $request->validate([
            'tentang' => ['required', 'string'],
        ]);

        $perwali->update($validated);

        return redirect()
            ->route('unit_layanan.profile.regulations')
            ->with('success_modal', 'Peraturan Wali Kota berhasil diperbarui.');
    }

    public function destroy(Perwali $perwali)
    {
        $this->authorizeOwnership($perwali);

        $perwali->delete();

        return redirect()
            ->route('unit_layanan.profile.regulations')
            ->with('success_modal', 'Peraturan Wali Kota berhasil dihapus.');
    }

    private function authorizeOwnership(Perwali $perwali): void
    {
        abort_unless(
            $perwali->id_instansi === $this->currentInstansiId(),
            403,
            'Anda tidak memiliki akses ke peraturan ini.'
        );
    }
}
