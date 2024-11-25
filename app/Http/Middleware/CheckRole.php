<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class CheckRole
{
   
    public function handle(Request $request, Closure $next, ...$roles): Response
    {

        $user = Auth::user();

        if (Auth::check() && in_array($user->role, $roles)) {
            return $next($request);
        }

        logger('User role is ' . Auth::user()->role);

        return redirect()->route('admin.login');
    }
}
