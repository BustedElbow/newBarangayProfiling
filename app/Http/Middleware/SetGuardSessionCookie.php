<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class SetGuardSessionCookie
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('resident')->check()) {
            Config::set('session.cookie', config('session.resident_cookie'));
        } elseif (Auth::guard('official')->check()) {
            Config::set('session.cookie', config('session.admin_cookie'));
        }

        return $next($request);
    }
}
