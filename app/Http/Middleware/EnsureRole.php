<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! in_array($user?->role?->nama_role, $roles, true)) {
            $route = match ($user?->role?->nama_role) {
                'admin' => 'admin.pengguna.index',
                'instansi' => 'instansi.profile',
                'unit_layanan' => 'unit_layanan.profile',
                default => null,
            };

            if ($route && Route::has($route)) {
                return redirect()
                    ->route($route)
                    ->withErrors(['akses' => 'Anda diarahkan ke halaman sesuai role akun.']);
            }

            return redirect()
                ->route('login')
                ->withErrors(['username' => 'Akun ini tidak memiliki akses ke halaman tersebut. Silakan masuk dengan akun yang sesuai.']);
        }

        if (in_array('unit_layanan', $roles, true)) {
            abort_unless(
                strtolower((string) $user?->instansi?->status) === 'aktif',
                403,
                'Akun unit layanan sedang tidak aktif.'
            );
            abort_unless(
                strtolower((string) $user?->instansi?->induk?->status) === 'aktif',
                403,
                'Instansi induk sedang tidak aktif.'
            );
        }

        if (in_array('instansi', $roles, true)) {
            abort_unless(
                strtolower((string) $user?->instansi?->status) === 'aktif',
                403,
                'Akun instansi sedang tidak aktif.'
            );
        }

        return $next($request);
    }
}
