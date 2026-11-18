<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Batasi akses berdasarkan role pengguna.
     * Pemakaian: ->middleware('role:admin') atau ->middleware('role:admin,dosen')
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // 1. Pastikan pengguna sudah login
        if (! $request->user()) {
            return redirect()->route('login');
        }

        // 2. Pastikan role pengguna termasuk daftar role yang diizinkan
        if (! in_array($request->user()->role, $roles, true)) {
            abort(403, 'Anda tidak memiliki hak akses!');
        }

        // 3. Lolos -> teruskan request
        return $next($request);
    }
}
