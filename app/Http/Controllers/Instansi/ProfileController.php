<?php

namespace App\Http\Controllers\Instansi;

use App\Http\Controllers\Controller;
use App\Models\Maklumat;
use App\Models\Perda;
use App\Models\Perwali;
use App\Models\ProfilUnitLayanan;
use App\Traits\ResolvesInstansiId;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    use ResolvesInstansiId;

    public function index(): View
    {
        abort_unless((int) auth()->user()->instansi?->level_instansi === 1, 403);

        $idInstansi = $this->currentInstansiId();
        $profile = ProfilUnitLayanan::where('id_instansi', $idInstansi)->first();
        $perdaList = Perda::where('id_instansi', $idInstansi)->latest()->get();
        $perwaliList = Perwali::where('id_instansi', $idInstansi)->latest()->get();
        $maklumatList = Maklumat::where('id_instansi', $idInstansi)
            ->where('status', 'disetujui')
            ->latest()
            ->get();

        return view('pages.instansi.profile.index', compact('profile', 'perdaList', 'perwaliList', 'maklumatList'));
    }

    public function update(Request $request): RedirectResponse
    {
        abort_unless((int) auth()->user()->instansi?->level_instansi === 1, 403);

        $validated = $request->validate([
            'nama_unit' => ['nullable', 'string', 'max:255'],
            'nama_kepala' => ['nullable', 'string', 'max:255'],
            'nama_jabatan' => ['nullable', 'string', 'max:255'],
            'jabatan' => ['nullable', 'in:Non PLT,PLT'],
            'website' => ['nullable', 'string', 'max:255'],
            'alamat' => ['nullable', 'string'],
            'nip' => ['nullable', 'string', 'max:50'],
            'pangkat' => ['nullable', 'string', 'max:100'],
            'email' => ['nullable', 'email', 'max:255'],
            'misi' => ['nullable', 'string'],
            'telepon' => ['nullable', 'string', 'max:50'],
            'faksimile' => ['nullable', 'string', 'max:50'],
            'motto' => ['nullable', 'string'],
            'visi' => ['nullable', 'string'],
        ]);

        ProfilUnitLayanan::updateOrCreate(
            ['id_instansi' => $this->currentInstansiId()],
            $validated
        );

        return redirect()
            ->route('instansi.profile')
            ->with('success_modal', 'Data profil instansi berhasil disimpan.');
    }

    public function unitLayanan(): View
    {
        $unitLayananList = auth()->user()->instansi->anak()
            ->where('level_instansi', 2)
            ->where('status', 'aktif')
            ->with(['pengguna' => fn ($query) => $query->latest('id_pengguna')])
            ->orderBy('nama_instansi')
            ->get();

        return view('pages.instansi.unit_layanan.index', compact('unitLayananList'));
    }

    public function regulations(): View
    {
        $idInstansi = $this->currentInstansiId();
        $perdaList = Perda::where('id_instansi', $idInstansi)->latest()->get();
        $perwaliList = Perwali::where('id_instansi', $idInstansi)->latest()->get();
        $namaUnit = auth()->user()->instansi->nama_instansi;

        return view('pages.instansi.perda_perwali.index', compact('perdaList', 'perwaliList', 'namaUnit'));
    }
}
