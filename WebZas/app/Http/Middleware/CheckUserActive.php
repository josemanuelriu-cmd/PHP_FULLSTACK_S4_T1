<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserActive
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->deactivated_at !== null) {
            Auth::logout();

            return redirect()->route('login')
                ->withErrors(['email' => 'Tu cuenta está desactivada.']);
        }

        return $next($request);
    }
}
