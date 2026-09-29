<?php

namespace App\Http\Controllers\Instansi;

use App\Http\Controllers\Controller;
use App\Models\Perda;
use App\Models\Perwali;
use App\Traits\ResolvesInstansiId;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PeraturanController extends Controller
{
    use ResolvesInstansiId;

    public function storePerda(Request $request): RedirectResponse
    {
        $validated = $request->validate(['tentang' => ['required', 'string']]);
        Perda::create([...$validated, 'id_instansi' => $this->currentInstansiId()]);

        return $this->backWithMessage('Peraturan Daerah berhasil ditambahkan.');
    }

    public function updatePerda(Request $request, Perda $perda): RedirectResponse
    {
        $this->authorizeOwnership($perda->id_instansi);
        $perda->update($request->validate(['tentang' => ['required', 'string']]));

        return $this->backWithMessage('Peraturan Daerah berhasil diperbarui.');
    }

    public function destroyPerda(Perda $perda): RedirectResponse
    {
        $this->authorizeOwnership($perda->id_instansi);
        $perda->delete();

        return $this->backWithMessage('Peraturan Daerah berhasil dihapus.');
    }

    public function storePerwali(Request $request): RedirectResponse
    {
        $validated = $request->validate(['tentang' => ['required', 'string']]);
        Perwali::create([...$validated, 'id_instansi' => $this->currentInstansiId()]);

        return $this->backWithMessage('Peraturan Wali Kota berhasil ditambahkan.');
    }

    public function updatePerwali(Request $request, Perwali $perwali): RedirectResponse
    {
        $this->authorizeOwnership($perwali->id_instansi);
        $perwali->update($request->validate(['tentang' => ['required', 'string']]));

        return $this->backWithMessage('Peraturan Wali Kota berhasil diperbarui.');
    }

    public function destroyPerwali(Perwali $perwali): RedirectResponse
    {
        $this->authorizeOwnership($perwali->id_instansi);
        $perwali->delete();

        return $this->backWithMessage('Peraturan Wali Kota berhasil dihapus.');
    }

    private function authorizeOwnership(int $idInstansi): void
    {
        abort_unless(
            $idInstansi === $this->currentInstansiId(),
            403,
            'Anda tidak memiliki akses ke peraturan ini.'
        );
    }

    private function backWithMessage(string $message): RedirectResponse
    {
        return redirect()
            ->route('instansi.perda_perwali.index')
            ->with('success', $message);
    }
}
