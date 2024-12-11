<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ResidentAuthenticatedSessionController extends Controller
{
    public function create(): View {
        return view('auth.login');
    }
    public function store(Request $request) {
        $credentials = $request->only('email', 'password');

        if(Auth::guard('resident')->attempt($credentials)) {
            $request->session()->regenerate();
            
            $user = Auth::guard('resident')->user();
            if($user->resident) {
                return redirect()->route('resident.home');
            } else {
                Auth::guard('resident')->logout();

                return back()->withErrors([
                    'email' => 'This account is not linked to a resident',
                ]);
            }
            
        }

        return back()->withErrors([
            'email' => 'Invalid credentials',
        ]);
    }

    public function destroy(Request $request) {
        Auth::guard('resident')->logout();

        // Only invalidate resident session
        if ($request->hasCookie('resident_session')) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return redirect()->route('login');
    }
}
