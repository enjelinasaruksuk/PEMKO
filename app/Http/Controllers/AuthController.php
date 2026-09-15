<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Pengguna;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    $pengguna = Pengguna::where('username', $request->username)->first();

    if (! $pengguna || $pengguna->status !== 'aktif') {
        return back()->withErrors(['username' => 'Akun tidak ditemukan atau belum aktif.']);
    }

    if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
        $request->session()->regenerate();

        $user = Auth::user();
        $user->update(['masuk_terakhir' => now()]);

        return redirect()->to($this->redirectPath($user));
    }

    return back()->withErrors(['username' => 'Username atau kata sandi salah.']);
}

private function redirectPath(Pengguna $user): string
{
    $roleName = $user->role->nama_role ?? '';

    return match ($roleName) {
        'admin' => Route::has('admin.pengguna.index') ? route('admin.pengguna.index') : '/admin/test',
        'instansi' => Route::has('instansi.profile') ? route('instansi.profile') : '/instansi/profile',
        'unit_layanan' => Route::has('unit_layanan.profile') ? route('unit_layanan.profile') : '/unit-layanan/profile',
        default => '/',
    };
}

    public function showRegister()
    {
        $instansiLevel1 = Instansi::where('level_instansi', 1)->where('status', 'aktif')->get();
        $instansiLevel2 = Instansi::where('level_instansi', 2)->where('status', 'aktif')->get();

        return view('auth.register', compact('instansiLevel1', 'instansiLevel2'));
    }

    public function register(Request $request)
{
    $request->validate([
        'level_akun' => 'required|in:1,2',
        'instansi_level_1' => 'required|exists:instansi,id_instansi',
        'instansi_level_2' => $request->level_akun == 2 ? 'required|exists:instansi,id_instansi' : 'nullable',
        'email' => 'required|email',
    ], [
        'instansi_level_1.required' => 'Instansi Level 1 wajib dipilih.',
        'instansi_level_2.required' => 'Instansi Level 2 wajib dipilih.',
        'email.required' => 'Email instansi wajib diisi.',
        'email.email' => 'Format email tidak valid.',
    ]);

    $levelAkun = (int) $request->level_akun;
    $idInstansiTerpilih = $levelAkun === 2
        ? $request->instansi_level_2
        : $request->instansi_level_1;

    $instansiTerpilih = Instansi::findOrFail($idInstansiTerpilih);

    // Cegah pengajuan dobel untuk instansi yang sama & masih pending
    $sudahAda = Pengguna::where('id_instansi', $instansiTerpilih->id_instansi)
        ->where('status', 'pending')
        ->exists();

    if ($sudahAda) {
        return back()->withErrors(['email' => 'Instansi ini sudah punya pengajuan yang masih menunggu persetujuan.'])->withInput();
    }

    $roleName = $levelAkun === 2 ? 'unit_layanan' : 'instansi';
    $role = Role::where('nama_role', $roleName)->first();

    if (! $role) {
        return back()->withErrors(['email' => 'Role belum tersedia di sistem, hubungi admin.'])->withInput();
    }

    Pengguna::create([
    'id_role' => $role->id_role,
    'id_instansi' => $instansiTerpilih->id_instansi,
    'nama_pengguna' => $instansiTerpilih->nama_instansi,
    'email' => $request->email,
    'username' => null,
    'password' => null,
    'status' => 'pending',
]);

    return redirect()->route('login')->with('success', 'Pengajuan akun berhasil dikirim. Menunggu persetujuan admin.');
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}