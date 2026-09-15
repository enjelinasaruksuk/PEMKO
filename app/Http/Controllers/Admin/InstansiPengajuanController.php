<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AkunDisetujuiMail;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class InstansiPengajuanController extends Controller
{
    public function index()
    {
        $pengajuanList = Pengguna::where('status', 'pending')
            ->with(['instansi.induk'])
            ->get()
            ->map(function ($pengguna) {
                $instansi = $pengguna->instansi;

                return (object) [
                    'id' => $pengguna->id_pengguna,
                    'instansi_level_1' => $instansi->level_instansi == 2 ? $instansi->induk->nama_instansi ?? '-' : $instansi->nama_instansi,
                    'instansi_level_2' => $instansi->level_instansi == 2 ? $instansi->nama_instansi : null,
                    'email' => $pengguna->email,
                    'status' => 'pending',
                ];
            });

        return view('pages.admin.instansi_pengajuan.index', compact('pengajuanList'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'keputusan' => 'required|in:disetujui,ditolak',
        ]);

        $pengguna = Pengguna::findOrFail($id);

        if ($request->keputusan === 'ditolak') {
            $pengguna->update(['status' => 'ditolak']);
            return redirect()->route('admin.instansi_pengajuan.index')->with('success', 'Pengajuan ditolak.');
        }

        $baseUsername = Str::slug($pengguna->instansi->nama_instansi, '');
        $username = $baseUsername;
        $counter = 1;

        while (Pengguna::where('username', $username)->exists()) {
            $username = $baseUsername . $counter;
            $counter++;
        }

        $passwordPlain = Str::random(8);

        $pengguna->update([
            'username' => $username,
            'password' => bcrypt($passwordPlain),
            'status' => 'aktif',
        ]);

        if ($pengguna->email) {
            Mail::to($pengguna->email)->send(new AkunDisetujuiMail($pengguna, $passwordPlain));
        }

        return redirect()->route('admin.instansi_pengajuan.index')->with('success', 'Akun disetujui, kredensial telah dikirim ke email.');
    }
}