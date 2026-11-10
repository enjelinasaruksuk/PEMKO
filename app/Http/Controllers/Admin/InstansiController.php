<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instansi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class InstansiController extends Controller
{
    public function index(): View
    {
        $instansiList = Instansi::with('induk')
            ->withCount(['anak', 'pengguna'])
            ->orderBy('level_instansi')
            ->orderBy('nama_instansi')
            ->get();

        $instansiLevel1 = $instansiList->where('level_instansi', 1)->values();

        return view('pages.admin.instansi.index', compact('instansiList', 'instansiLevel1'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);

        Instansi::create($data);

        return redirect()
            ->route('admin.instansi.index')
            ->with('success', 'Instansi berhasil ditambahkan.');
    }

    public function update(Request $request, Instansi $instansi): RedirectResponse
    {
        $data = $this->validated($request, $instansi);

        $levelBerubah = (int) $data['level_instansi'] !== (int) $instansi->level_instansi;

        if ($levelBerubah && ($instansi->anak()->exists() || $instansi->pengguna()->exists())) {
            return back()->withErrors([
                'level_instansi' => 'Level tidak dapat diubah karena instansi ini sudah memiliki unit di bawahnya atau akun pengguna.',
            ]);
        }

        $instansi->update($data);

        return redirect()
            ->route('admin.instansi.index')
            ->with('success', 'Instansi berhasil diperbarui.');
    }

    public function destroy(Instansi $instansi): RedirectResponse
    {
        $alasan = collect([
            'unit layanan di bawahnya' => $instansi->anak()->exists(),
            'akun pengguna' => $instansi->pengguna()->exists(),
            'data SK' => $instansi->sk()->exists(),
            'data layanan' => $instansi->pelayanan()->exists(),
            'data maklumat' => $instansi->maklumat()->exists(),
        ])->filter()->keys();

        if ($alasan->isNotEmpty()) {
            return redirect()
                ->route('admin.instansi.index')
                ->withErrors([
                    'instansi' => 'Instansi tidak dapat dihapus karena masih memiliki '
                        .$alasan->implode(', ').'. Gunakan status Nonaktif sebagai gantinya.',
                ]);
        }

        $instansi->delete();

        return redirect()
            ->route('admin.instansi.index')
            ->with('success', 'Instansi berhasil dihapus.');
    }

    private function validated(Request $request, ?Instansi $instansi = null): array
    {
        $idSendiri = $instansi?->id_instansi;

        $data = $request->validate([
            'nama_instansi' => [
                'required', 'string', 'max:255',
                Rule::unique('instansi', 'nama_instansi')->ignore($idSendiri, 'id_instansi'),
            ],
            'level_instansi' => ['required', 'in:1,2'],
            'id_instansi_induk' => [
                Rule::requiredIf(fn () => $request->input('level_instansi') == 2),
                'nullable',
                Rule::exists('instansi', 'id_instansi')->where('level_instansi', 1),
                Rule::notIn([$idSendiri]),
            ],
            // Dikosongkan = akan terisi otomatis saat akun pertama disetujui.
            'email_instansi' => ['nullable', 'email', 'max:255'],
            'status' => ['required', 'in:aktif,nonaktif'],
        ], [
            'nama_instansi.required' => 'Nama instansi wajib diisi.',
            'nama_instansi.unique' => 'Nama instansi sudah terdaftar.',
            'id_instansi_induk.required' => 'Instansi Level 2 wajib memilih instansi induk (Level 1).',
            'id_instansi_induk.exists' => 'Instansi induk harus berupa instansi Level 1.',
            'email_instansi.email' => 'Format email tidak valid.',
        ]);

        // Level 1 tidak punya induk.
        if ((int) $data['level_instansi'] === 1) {
            $data['id_instansi_induk'] = null;
        }

        return $data;
    }
}