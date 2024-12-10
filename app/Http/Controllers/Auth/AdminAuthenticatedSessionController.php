<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;

class AdminAuthenticatedSessionController extends Controller
{
    // Display the login form for officials
    public function create(): View {
        return view('auth.admin-login');
    }

    // Handle login requests
    public function store(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Attempt authentication
        if (Auth::guard('official')->attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::guard('official')->user();

            // Debug: Log the authenticated user
            Log::info('Authenticated User:', $user->toArray());

            // Check if user is linked to a resident
            if ($user->resident) {
                $resident = $user->resident;

                // Debug: Log associated resident
                Log::info('Associated Resident:', $resident->toArray());

                // Check if the resident is linked to an active official record
                if ($resident->official && $resident->official->is_active) {
                    // Debug: Log associated official
                    Log::info('Associated Official:', $resident->official->toArray());

                    return redirect()->route('admin.dashboard');
                } else {
                    Auth::guard('official')->logout();

                    return back()->withErrors([
                        'email' => 'This account is not linked to an active official record.',
                    ]);
                }
            } else {
                Auth::guard('official')->logout();

                return back()->withErrors([
                    'email' => 'This account is not linked to a resident record.',
                ]);
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    // Handle logout requests
    public function destroy(Request $request): RedirectResponse {
        Auth::guard('official')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
