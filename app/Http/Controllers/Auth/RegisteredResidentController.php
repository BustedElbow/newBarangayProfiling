<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Resident;
use App\Models\User;
use App\Models\BloodRelation;
use Illuminate\Support\Facades\Hash;

class RegisteredResidentController extends Controller
{
    
    public function create(): View {
        $current_step = session('current_step', 1);

        return view('auth.admin.resident.register', compact('current_step'));
    }

    
}
