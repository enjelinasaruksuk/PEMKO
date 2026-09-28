<?php

namespace App\Http\Controllers\UnitLayanan;

use App\Http\Controllers\Controller;
use App\Http\Requests\UnitLayanan\StoreSkRequest;
use App\Http\Requests\UnitLayanan\UpdateSkRequest;
use App\Http\Requests\UnitLayanan\UpdateSkStatusRequest;
use App\Models\Sk;
use App\Traits\ResolvesInstansiId;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SkController extends Controller
{
    use ResolvesInstansiId;

    public function index(): View
    {
        $skList = Sk::query()
            ->milikInstansi($this->currentInstansiId())
            ->with('instansi')
            ->latest('tanggal_sk')
            ->get();

        return view('pages.unit-layanan.sk.index', compact('skList'));
    }

    public function create(): View
    {
        return view('pages.unit-layanan.sk.create');
    }

    public function store(StoreSkRequest $request): RedirectResponse
    {
        Sk::create([
            ...$request->validated(),
            'id_instansi' => $this->currentInstansiId(),
        ]);

        return redirect()
            ->route('unit_layanan.sk.index')
            ->with('success', 'Data SK berhasil disimpan.');
    }

    public function edit(Sk $sk): View
    {
        $this->authorizeOwnership($sk);

        return view('pages.unit-layanan.sk.edit', ['sk' => $sk]);
    }

    public function update(UpdateSkRequest $request, Sk $sk): RedirectResponse
    {
        $this->authorizeOwnership($sk);

        // SK yang sudah disetujui tidak boleh diubah lagi dari sisi unit layanan.
        abort_if(
            $sk->pengesahan === 'Sudah disetujui',
            403,
            'SK yang sudah disetujui tidak dapat diubah.'
        );

        $sk->update($request->validated());

        return redirect()
            ->route('unit_layanan.sk.index')
            ->with('success', 'Data SK berhasil diperbarui.');
    }

    public function updateStatus(UpdateSkStatusRequest $request, Sk $sk): RedirectResponse
    {
        $this->authorizeOwnership($sk);

        $sk->update($request->validated());

        return redirect()
            ->route('unit_layanan.sk.index')
            ->with('success', 'Status SK berhasil diperbarui.');
    }

    public function destroy(Sk $sk): RedirectResponse
    {
        $this->authorizeOwnership($sk);

        abort_if(
            $sk->pengesahan === 'Sudah disetujui',
            403,
            'SK yang sudah disetujui tidak dapat dihapus.'
        );

        $sk->delete();

        return redirect()
            ->route('unit_layanan.sk.index')
            ->with('success', 'Data SK berhasil dihapus.');
    }

    /**
     * Pastikan record yang diakses benar-benar milik instansi yang login.
     */
    private function authorizeOwnership(Sk $sk): void
    {
        abort_unless(
            $sk->id_instansi === $this->currentInstansiId(),
            403,
            'Anda tidak memiliki akses ke data SK ini.'
        );
    }
}
