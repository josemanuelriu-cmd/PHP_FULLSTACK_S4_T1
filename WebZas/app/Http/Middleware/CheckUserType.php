<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    /**
     * Handle an incoming request.
     * $types puede ser un string o un array de tipos permitidos.
     */
    public function handle(Request $request, Closure $next, ...$types)
    {
        $user = Auth::user();

        if (!$user || !in_array($user->type, $types)) {
            abort(403, 'No tienes permisos para acceder a esta página.');
        }

        return $next($request);
    }
}
