<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instansi;
use App\Models\Sk;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SkController extends Controller
{
    public function index(): View
    {
        $skList = Sk::query()
            ->where('review_status', Sk::REVIEW_PENDING_ADMIN)
            ->with(['instansi.induk'])
            ->withCount('pelayanan')
            ->latest('submitted_at')
            ->get();

        return view('pages.admin.sk.index', compact('skList'));
    }

    public function show(Sk $sk): View
    {
        abort_unless($sk->review_status === Sk::REVIEW_PENDING_ADMIN, 404);

        $sk->load(['instansi.induk', 'pelayanan']);

        return view('pages.admin.sk.show', compact('sk'));
    }

    public function forward(Sk $sk): RedirectResponse
    {
        abort_unless($sk->review_status === Sk::REVIEW_PENDING_ADMIN, 404);
        abort_unless($sk->status === 'Aktif', 422, 'SK harus aktif untuk diteruskan.');
        abort_unless($sk->pelayanan()->exists(), 422, 'SK belum memiliki layanan.');

        $owner = $sk->instansi;
        abort_if(! $owner, 404, 'Pemilik SK tidak ditemukan.');

        $idInstansiTujuan = $owner->level_instansi === 2
            ? $owner->id_instansi_induk
            : $owner->id_instansi;

        abort_unless(
            $idInstansiTujuan && Instansi::whereKey($idInstansiTujuan)->where('status', 'aktif')->exists(),
            422,
            'Instansi tujuan belum aktif.'
        );

        $sk->update([
            'review_status' => Sk::REVIEW_PENDING_INSTANSI,
            'review_comment' => null,
            'admin_reviewed_at' => now(),
        ]);

        return redirect()
            ->route('admin.sk.index')
            ->with('success', 'SK dinyatakan sesuai dan diteruskan ke Instansi untuk disetujui.');
    }

    public function returnToOwner(Request $request, Sk $sk): RedirectResponse
    {
        abort_unless($sk->review_status === Sk::REVIEW_PENDING_ADMIN, 404);

        $validated = $request->validate([
            'review_comment' => ['required', 'string', 'max:5000'],
        ]);

        $sk->update([
            'review_status' => Sk::REVIEW_NEEDS_CHANGES,
            'review_comment' => $validated['review_comment'],
            'admin_reviewed_at' => now(),
        ]);

        return redirect()
            ->route('admin.sk.index')
            ->with('success', 'SK dikembalikan kepada pemilik untuk diperbaiki.');
    }
}
