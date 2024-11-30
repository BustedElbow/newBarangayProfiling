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
    public function create(): View {
        return view('auth.admin-login');
    }

    public function store(Request $request) {
        $credentials = $request->only('email','password');


    }

    public function destroy(Request $request) {
        Auth::guard('official')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('');
    }

}
