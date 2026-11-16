<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instansi;
use App\Models\Sk;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SkController extends Controller
{
    public function index(): View
    {
        $skList = Sk::query()
            ->whereIn('review_status', [
                Sk::REVIEW_PENDING_ADMIN,
                Sk::REVIEW_NEEDS_CHANGES,
            ])
            ->with(['instansi.induk'])
            ->with('messages')
            ->withCount('pelayanan')
            ->latest('submitted_at')
            ->get();

        return view('pages.admin.sk.index', compact('skList'));
    }

    public function show(Sk $sk): View
    {
        abort_unless(in_array($sk->review_status, [
            Sk::REVIEW_PENDING_ADMIN,
            Sk::REVIEW_NEEDS_CHANGES,
        ], true), 404);

        $sk->load(['instansi.induk', 'pelayanan', 'messages']);

        return view('pages.admin.sk.show', compact('sk'));
    }

    public function replyToOwner(Request $request, Sk $sk): RedirectResponse
    {
        abort_unless($sk->review_status === Sk::REVIEW_NEEDS_CHANGES, 404);

        $validated = $request->validate([
            'review_comment' => ['required', 'string', 'max:5000'],
            'return_to' => ['nullable', 'in:detail,index'],
        ]);

        $this->saveAdminMessage($sk, $request, $validated['review_comment']);

        return $this->conversationRedirect(
            $request,
            $sk,
            'Balasan berhasil dikirim kepada Unit Pelayanan.'
        );
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
            'return_to' => ['nullable', 'in:detail,index'],
        ]);

        DB::transaction(function () use ($sk, $request, $validated): void {
            $this->saveAdminMessage($sk, $request, $validated['review_comment']);
            $sk->update([
                'review_status' => Sk::REVIEW_NEEDS_CHANGES,
                'admin_reviewed_at' => now(),
            ]);
        });

        return $this->conversationRedirect(
            $request,
            $sk,
            'SK dikembalikan kepada pemilik untuk diperbaiki.'
        );
    }

    private function conversationRedirect(Request $request, Sk $sk, string $message): RedirectResponse
    {
        if ($request->input('return_to') === 'detail') {
            return redirect()
                ->route('admin.sk.show', $sk)
                ->with('success', $message);
        }

        return redirect()
            ->route('admin.sk.index', ['conversation' => $sk->id])
            ->with('success', $message);
    }

    private function saveAdminMessage(Sk $sk, Request $request, string $message): void
    {
        $sender = $request->user();

        DB::transaction(function () use ($sk, $sender, $message): void {
            $sk->messages()->create([
                'sender_role' => 'admin',
                'sender_name' => $sender->nama_pengguna ?? $sender->name ?? $sender->username ?? 'Admin',
                'message' => $message,
            ]);

            $sk->update([
                'review_comment' => $message,
                'admin_reviewed_at' => now(),
            ]);
        });
    }
}
