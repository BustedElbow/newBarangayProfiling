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

        if (Auth::guard('official')->attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::guard('official')->user();

            if ($user->resident) {
                $resident = $user->resident;

                if ($resident->official) {
                    $official = $resident->official;

                    // Check if term has ended
                    if ($official->isTermEnded()) {
                        // Update is_active to false
                        $official->update(['is_active' => false]);

                        Auth::guard('official')->logout();
                        return back()->withErrors([
                            'email' => 'Your term has ended. Access denied.',
                        ]);
                    }

                    // Check if official is active
                    if ($official->is_active) {
                        return redirect()->route('admin.dashboard');
                    }
                }

                Auth::guard('official')->logout();
                return back()->withErrors([
                    'email' => 'This account is not linked to an active official record.',
                ]);
            }

            Auth::guard('official')->logout();
            return back()->withErrors([
                'email' => 'This account is not linked to a resident record.',
            ]);
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    // Handle logout requests
    public function destroy(Request $request): RedirectResponse {
        Auth::guard('official')->logout();

        // Only invalidate admin session
        if ($request->hasCookie('admin_session')) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return redirect('/');
    }
}
