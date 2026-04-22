<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // belum login
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // role tidak diizinkan
        if (! in_array($user->role, $roles)) {
            return redirect()->route(
                $user->role === 'admin'
                    ? 'admin.dashboard'
                    : 'pelajar.dashboard'
            );
        }

        return $next($request);
    }
}
