<?php

namespace App\Http\Controllers\UnitLayanan;

use App\Http\Controllers\Controller;
use App\Models\Maklumat;
use App\Models\Perda;
use App\Models\Perwali;
use App\Models\ProfilUnitLayanan;
use App\Traits\ResolvesInstansiId;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use ResolvesInstansiId;

    public function index()
    {
        abort_unless((int) auth()->user()->instansi?->level_instansi === 2, 403);

        $idInstansi = $this->currentInstansiId();
        $idInstansiInduk = $this->currentInduknyaInstansiId();

        $profile = ProfilUnitLayanan::where('id_instansi', $idInstansi)->first();
        $perdaList = Perda::where('id_instansi', $idInstansi)->latest()->get();
        $perwaliList = Perwali::where('id_instansi', $idInstansi)->latest()->get();
        $maklumatList = Maklumat::where('id_instansi', $idInstansiInduk)
            ->where('status', 'disetujui')
            ->latest()
            ->get();

        return view(
            'pages.unit-layanan.profile.index',
            compact('profile', 'perdaList', 'perwaliList', 'maklumatList')
        );
    }

    public function update(Request $request)
    {
        abort_unless((int) auth()->user()->instansi?->level_instansi === 2, 403);

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
            ->route('unit_layanan.profile')
            ->with('success_modal', 'Data profil unit layanan berhasil disimpan.');
    }

    public function regulations()
    {
        $idInstansi = $this->currentInstansiId();

        $perda = Perda::where('id_instansi', $idInstansi)->latest()->get();
        $perwali = Perwali::where('id_instansi', $idInstansi)->latest()->get();

        return view(
            'pages.unit-layanan.profile.regulations.index',
            compact('perda', 'perwali')
        );
    }
}
