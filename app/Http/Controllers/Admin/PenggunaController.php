<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\PasswordDiaturUlangMail;
use App\Models\Instansi;
use App\Models\Pengguna;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
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
                $level = (int) ($instansi?->level_instansi ?? 0);
                $namaRole = $pengguna->role?->nama_role;

                return (object) [
                    'id' => $pengguna->id_pengguna,
                    'nama' => $pengguna->nama_pengguna,
                    'email' => $pengguna->email,
                    'instansi_nama' => $level === 2
                        ? ($instansi->induk?->nama_instansi ?? '-')
                        : ($instansi?->nama_instansi ?? '-'),
                    'instansi_singkatan' => $instansi?->nama_instansi ?? '-',
                    'peran' => match ($namaRole) {
                        'instansi' => 'Instansi Level 1',
                        'unit_layanan' => 'Unit Layanan Level 2',
                        'admin' => 'Admin',
                        default => '-',
                    },
                    'status' => ucfirst((string) $pengguna->status),
                    'status_raw' => $pengguna->status,
                    'masuk_terakhir' => $pengguna->masuk_terakhir?->format('d M Y H:i') ?? '-',
                    'can_manage' => in_array($namaRole, ['instansi', 'unit_layanan'], true),
                    'is_self' => (int) $pengguna->id_pengguna === (int) auth()->id(),
                    'level_akun' => $level === 2 ? 2 : 1,
                    'id_instansi_level_1' => $level === 2 ? $instansi->id_instansi_induk : $instansi?->id_instansi,
                    'id_instansi_level_2' => $level === 2 ? $instansi->id_instansi : null,
                ];
            });

        $instansiLevel1 = Instansi::where('level_instansi', 1)
            ->where('status', 'aktif')
            ->orderBy('nama_instansi')
            ->get();

        $instansiLevel2 = Instansi::where('level_instansi', 2)
            ->where('status', 'aktif')
            ->orderBy('nama_instansi')
            ->get();

        return view('pages.admin.pengguna.index', compact('penggunaList', 'instansiLevel1', 'instansiLevel2'));
    }

    public function update(Request $request, Pengguna $pengguna): RedirectResponse
    {
        abort_unless(
            in_array($pengguna->role?->nama_role, ['instansi', 'unit_layanan'], true),
            404
        );

        $level = (int) $request->input('level_akun');

        $validated = $request->validate([
            'level_akun' => ['required', Rule::in([1, 2])],
            'instansi_level_1' => [
                'required',
                Rule::exists('instansi', 'id_instansi')->where('level_instansi', 1),
            ],
            'instansi_level_2' => [
                Rule::requiredIf($level === 2),
                'nullable',
                Rule::exists('instansi', 'id_instansi')->where(function ($query) use ($request) {
                    $query->where('level_instansi', 2)
                        ->where('id_instansi_induk', $request->input('instansi_level_1'));
                }),
            ],
            'email' => ['required', 'email', 'max:255'],
        ]);

        $instansi = Instansi::findOrFail(
            $level === 2 ? $validated['instansi_level_2'] : $validated['instansi_level_1']
        );

        $role = Role::where('nama_role', $level === 2 ? 'unit_layanan' : 'instansi')->firstOrFail();

        // username sengaja tidak diubah: kredensial yang sudah dikirim ke email harus tetap berlaku.
        $pengguna->update([
            'id_role' => $role->id_role,
            'id_instansi' => $instansi->id_instansi,
            'nama_pengguna' => $instansi->nama_instansi,
            'email' => $validated['email'],
        ]);

        return redirect()
            ->route('admin.pengguna.index')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function toggleStatus(Pengguna $pengguna): RedirectResponse
    {
        abort_if(
            (int) $pengguna->id_pengguna === (int) auth()->id(),
            422,
            'Anda tidak dapat menonaktifkan akun sendiri.'
        );

        abort_unless(
            in_array($pengguna->status, ['aktif', 'nonaktif'], true),
            422,
            'Hanya akun aktif atau nonaktif yang dapat diubah statusnya.'
        );

        $pengguna->update([
            'status' => $pengguna->status === 'aktif' ? 'nonaktif' : 'aktif',
        ]);

        return redirect()
            ->route('admin.pengguna.index')
            ->with('success', 'Status akun berhasil diubah menjadi '.$pengguna->status.'.');
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

        $password = $pengguna->username.'2026';

        DB::transaction(function () use ($pengguna, $password): void {
            $pengguna->update(['password' => Hash::make($password)]);

            Mail::to($pengguna->email)
                ->send(new PasswordDiaturUlangMail($pengguna, $password));
        });

        return redirect()
            ->route('admin.pengguna.index')
            ->with('success', 'Password baru telah dikirim ke email pengguna.');
    }

    public function destroy(Pengguna $pengguna): RedirectResponse
    {
        abort_if(
            (int) $pengguna->id_pengguna === (int) auth()->id(),
            422,
            'Anda tidak dapat menghapus akun sendiri.'
        );

        abort_if(
            $pengguna->role?->nama_role === 'admin',
            403,
            'Akun admin tidak dapat dihapus.'
        );

        $pengguna->delete();

        return redirect()
            ->route('admin.pengguna.index')
            ->with('success', 'Akun pengguna berhasil dihapus.');
    }
}