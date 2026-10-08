<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\PasswordDiaturUlangMail;
use App\Models\Pengguna;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PenggunaController extends Controller
{
    public function index(): View
    {
        $penggunaList = Pengguna::with(['role', 'instansi.induk'])
            ->latest('id_pengguna')
            ->get()
            ->map(function (Pengguna $pengguna) {
                $instansi = $pengguna->instansi;

                return (object) [
                    'id' => $pengguna->id_pengguna,
                    'nama' => $pengguna->nama_pengguna,
                    'email' => $pengguna->email,
                    'instansi_nama' => $instansi?->level_instansi === 2
                        ? ($instansi->induk?->nama_instansi ?? '-')
                        : ($instansi?->nama_instansi ?? '-'),
                    'instansi_singkatan' => $instansi?->nama_instansi ?? '-',
                    'peran' => match ($pengguna->role?->nama_role) {
                        'instansi' => 'Instansi Level 1',
                        'unit_layanan' => 'Unit Layanan Level 2',
                        'admin' => 'Admin',
                        default => '-',
                    },
                    'status' => ucfirst((string) $pengguna->status),
                    'masuk_terakhir' => $pengguna->masuk_terakhir?->format('d M Y H:i') ?? '-',
                ];
            });

        return view('pages.admin.pengguna.index', compact('penggunaList'));
    }

    public function resetPassword(Pengguna $pengguna): RedirectResponse
{
    abort_unless(
        in_array($pengguna->role?->nama_role, ['instansi', 'unit_layanan'], true),
        404
    );

    abort_if(
        blank($pengguna->email),
        422,
        'Akun ini belum memiliki email untuk menerima password baru.'
    );

    $password = $pengguna->username . '2026';

    DB::transaction(function () use ($pengguna, $password): void {
        $pengguna->update(['password' => Hash::make($password)]);

        Mail::to($pengguna->email)
            ->send(new PasswordDiaturUlangMail($pengguna, $password));
    });

    return redirect()
        ->route('admin.pengguna.index')
        ->with('success', 'Password baru telah dikirim ke email pengguna.');
}
}
