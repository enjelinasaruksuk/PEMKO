<?php

namespace App\Http\Controllers\Instansi;

use App\Http\Controllers\Controller;
use App\Models\Instansi;
use App\Models\ProfilUnitLayanan;
use App\Models\Sk;
use App\Models\TandaTangan;
use App\Traits\ResolvesInstansiId;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class SkController extends Controller
{
    use ResolvesInstansiId;

    public function index(): View
    {
        $unitLayananList = Instansi::where('id_instansi_induk', $this->currentInstansiId())
            ->where('level_instansi', 2)
            ->where('status', 'aktif')
            ->withCount('pengguna')
            ->orderBy('nama_instansi')
            ->get();

        return view('pages.instansi.sk.index', compact('unitLayananList'));
    }

    public function show(Instansi $unit): View
    {
        $this->authorizeUnit($unit);
        $skList = Sk::where('id_instansi', $unit->id_instansi)
            ->whereIn('review_status', [Sk::REVIEW_PENDING_INSTANSI, Sk::REVIEW_APPROVED])
            ->with('instansi')
            ->withCount('pelayanan')
            ->latest('tanggal_sk')
            ->get();

        $namaUnit = $unit->nama_instansi;

        return view('pages.instansi.sk.show', compact('skList', 'namaUnit', 'unit'));
    }

    public function approve(Request $request, Instansi $unit, Sk $sk)
    {
        $this->authorizeUnit($unit);
        $request->validate(['status_approval' => ['required', 'in:disetujui,ditolak']]);

        abort_unless($sk->id_instansi === $unit->id_instansi, 404);

        if ($request->status_approval === 'ditolak') {
            $sk->update([
                'pengesahan' => 'Belum disetujui',
                'konfirmasi' => 'Menunggu',
                'review_status' => Sk::REVIEW_NEEDS_CHANGES,
                'review_comment' => 'SK dikembalikan oleh Instansi untuk diperbaiki. Silakan periksa kembali data dan layanan.',
                'ttd_nama' => null,
                'ttd_nip' => null,
                'ttd_pangkat' => null,
                'ttd_jabatan' => null,
            ]);

            return back()->with('success', 'Pengesahan dibatalkan dan SK dikembalikan untuk diperbaiki.');
        }

        abort_unless(
            $sk->review_status === Sk::REVIEW_PENDING_INSTANSI,
            422,
            'SK belum diteruskan Admin untuk disetujui.'
        );
        abort_unless($sk->status === 'Aktif', 422, 'Aktifkan SK sebelum memberikan pengesahan.');
        abort_unless($sk->pelayanan()->exists(), 422, 'Pilih minimal satu layanan sebelum SK disahkan.');

        $this->approveWithOwnerSignature($sk, $unit);

        return back()->with('success', 'SK disetujui.');
    }

    public function approveOwned(Request $request, Sk $sk)
    {
        $request->validate(['status_approval' => ['required', 'in:disetujui,ditolak']]);
        $instansi = auth()->user()->instansi;
        abort_unless($instansi && $instansi->level_instansi === 1, 403);
        abort_unless($sk->id_instansi === $instansi->id_instansi, 404);

        if ($request->status_approval === 'ditolak') {
            $sk->update([
                'pengesahan' => 'Belum disetujui',
                'konfirmasi' => 'Menunggu',
                'review_status' => Sk::REVIEW_NEEDS_CHANGES,
                'review_comment' => 'SK dikembalikan oleh Instansi untuk diperbaiki. Silakan periksa kembali data dan layanan.',
                'ttd_nama' => null,
                'ttd_nip' => null,
                'ttd_pangkat' => null,
                'ttd_jabatan' => null,
            ]);

            return back()->with('success', 'SK dikembalikan untuk diperbaiki.');
        }

        abort_unless($sk->review_status === Sk::REVIEW_PENDING_INSTANSI, 422, 'SK belum diteruskan Admin untuk disetujui.');
        abort_unless($sk->status === 'Aktif', 422, 'SK harus aktif sebelum disahkan.');
        abort_unless($sk->pelayanan()->exists(), 422, 'Pilih minimal satu layanan sebelum SK disahkan.');

        $this->approveWithOwnerSignature($sk, $instansi);

        return back()->with('success', 'SK disetujui.');
    }

    private function approveWithOwnerSignature(Sk $sk, Instansi $owner): void
    {
        $profil = ProfilUnitLayanan::where('id_instansi', $owner->id_instansi)->first();

        if (! $profil || ! $profil->nama_kepala || ! $profil->nip) {
            throw ValidationException::withMessages([
                'profil' => 'Lengkapi profil pemilik SK (nama kepala dan NIP) sebelum SK disahkan.',
            ]);
        }

        $nip = preg_replace('/\D/', '', $profil->nip);
        $tandaTangan = $nip ? TandaTangan::find($nip) : null;

        if (! $tandaTangan || ! Storage::disk('local')->exists($tandaTangan->path)) {
            throw ValidationException::withMessages([
                'ttd' => 'Spesimen tanda tangan untuk NIP pejabat belum tersedia di database.',
            ]);
        }

        $sk->update([
            'pengesahan' => 'Sudah disetujui',
            'konfirmasi' => 'Sudah disetujui',
            'review_status' => Sk::REVIEW_APPROVED,
            'review_comment' => null,
            'ttd_nama' => $profil->nama_kepala,
            'ttd_nip' => $profil->nip,
            'ttd_pangkat' => $profil->pangkat,
            'ttd_jabatan' => ($profil->jabatan === 'PLT' ? 'Plt. ' : '')
                             .($profil->nama_jabatan ?: $profil->nama_unit),
        ]);
    }

    private function authorizeUnit(Instansi $unit): void
    {
        abort_unless(
            $unit->level_instansi === 2
                && $unit->id_instansi_induk === $this->currentInstansiId()
                && strtolower($unit->status) === 'aktif',
            404,
            'Unit layanan tidak ditemukan.'
        );
    }
}
