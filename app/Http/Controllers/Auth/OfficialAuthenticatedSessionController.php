<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OfficialAuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.admin-login');
    }

    // Handle the login request
    public function store(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Attempt to authenticate the official
        if (Auth::guard('official')->attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::guard('official')->user();

            // Check if the official is active
            if ($user->isActive) {
                return redirect()->route('official.dashboard');
            } else {
                // Logout and return error if the official is inactive
                Auth::guard('official')->logout();

                return back()->withErrors([
                    'email' => 'This account is no longer active.',
                ]);
            }
        }

        // If authentication fails
        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    // Handle the logout request
    public function destroy(Request $request)
    {
        Auth::guard('official')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin-login'); // Update the route name if necessary
    }
}
