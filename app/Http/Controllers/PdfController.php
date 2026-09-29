<?php

namespace App\Http\Controllers;

use App\Models\Maklumat;
use App\Models\Perda;
use App\Models\Perwali;
use App\Models\ProfilUnitLayanan;
use App\Models\Sk;
use App\Models\TandaTangan;
use App\Traits\ResolvesInstansiId;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    use ResolvesInstansiId;

    public function sk(Sk $sk)
    {
        abort_unless(
            $sk->status === 'Aktif'
                && $sk->review_status === Sk::REVIEW_APPROVED
                && $sk->pengesahan === 'Sudah disetujui'
                && $sk->konfirmasi === 'Sudah disetujui',
            403,
            'SK belum selesai diperiksa dan disahkan.'
        );

        return $this->renderSk($sk);
    }

    public function previewSk(Sk $sk)
    {
        abort_unless(optional(auth()->user()->role)->nama_role === 'admin', 403);
        abort_unless($sk->review_status === Sk::REVIEW_PENDING_ADMIN, 404);

        return $this->renderSk($sk, true);
    }

    private function renderSk(Sk $sk, bool $preview = false)
    {
        $unit = $sk->instansi;
        $this->authorizeAkses($sk);

        $kop = ProfilUnitLayanan::where('id_instansi', $unit->id_instansi)->first();

        abort_if(! $kop, 404, 'Profil pemilik SK belum dilengkapi, kop surat belum bisa dibuat.');
        $perdaList = Perda::where('id_instansi', $unit->id_instansi)->orderBy('id')->get();
        $perwaliList = Perwali::where('id_instansi', $unit->id_instansi)->orderBy('id')->get();

        $ttd = $preview ? null : $this->signatureImage($sk->ttd_nip ?? '');

        $logoPath = public_path('images/logo-batam.png');
        $logo = file_exists($logoPath)
            ? 'data:image/png;base64,'.base64_encode(file_get_contents($logoPath))
            : null;

        return Pdf::loadView('pdf.sk', [
            'sk' => $sk,
            'namaUnit' => $unit->nama_instansi,
            'kop' => $kop,
            'logo' => $logo,
            'ttd' => $ttd,
            'layananList' => $sk->pelayanan()->orderBy('nama_layanan')->get(),
            'perdaList' => $perdaList,
            'perwaliList' => $perwaliList,
        ])->setPaper('a4')->stream(($preview ? 'Draf-SK-' : 'SK-').$sk->id.'.pdf');
    }

    public function maklumat(Maklumat $maklumat)
    {
        abort_unless($maklumat->status === 'disetujui', 403, 'Maklumat belum disetujui.');
        $this->authorizeMaklumat($maklumat);

        $kop = ProfilUnitLayanan::where('id_instansi', $maklumat->id_instansi)->first();
        abort_if(! $kop, 404, 'Profil instansi belum dilengkapi, kop surat belum bisa dibuat.');

        $nip = preg_replace('/\D/', '', $maklumat->nip_penjabat ?: ($kop->nip ?? ''));
        $ttd = $this->signatureImage($nip);

        $logoPath = public_path('images/logo-batam.png');
        $logo = file_exists($logoPath)
            ? 'data:image/png;base64,'.base64_encode(file_get_contents($logoPath))
            : null;

        return Pdf::loadView('pdf.maklumat', [
            'maklumat' => $maklumat,
            'kop' => $kop,
            'logo' => $logo,
            'ttd' => $ttd,
            'nip' => $nip,
            'namaPejabat' => $maklumat->nama_penjabat ?: $kop->nama_kepala,
        ])->setPaper('a4')->stream('Maklumat-'.$maklumat->id.'.pdf');
    }

    /**
     * Admin: semua. Unit pemilik SK: boleh. Instansi induknya: boleh.
     */
    private function authorizeAkses(Sk $sk): void
    {
        $user = auth()->user();

        if (optional($user->role)->nama_role === 'admin') {
            return;
        }

        $idSaya = $user->id_instansi;
        $idPemilik = $sk->id_instansi;
        $idInduk = optional($sk->instansi)->id_instansi_induk;

        abort_unless($idSaya && ($idSaya === $idPemilik || $idSaya === $idInduk), 403);
    }

    private function authorizeMaklumat(Maklumat $maklumat): void
    {
        $user = auth()->user();
        $role = optional($user->role)->nama_role;

        if ($role === 'admin') {
            return;
        }

        $idInstansiUser = $user->id_instansi;
        $idIndukUser = $user->instansi?->id_instansi_induk;
        $bolehAkses = $role === 'instansi'
            ? $idInstansiUser === $maklumat->id_instansi
            : $role === 'unit_layanan' && $idIndukUser === $maklumat->id_instansi;

        abort_unless($bolehAkses, 403, 'Anda tidak memiliki akses ke Maklumat ini.');
    }

    private function signatureImage(string $nip): string
    {
        $nip = preg_replace('/\D/', '', $nip);
        $signature = $nip ? TandaTangan::find($nip) : null;

        abort_if(! $signature, 422, 'Spesimen tanda tangan untuk NIP pejabat tidak ditemukan.');
        abort_unless(
            Storage::disk('local')->exists($signature->path),
            422,
            'File spesimen tanda tangan untuk NIP pejabat tidak ditemukan.'
        );

        return 'data:image/png;base64,'.base64_encode(Storage::disk('local')->get($signature->path));
    }
}
