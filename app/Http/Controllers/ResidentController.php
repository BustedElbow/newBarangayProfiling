<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Resident;

class ResidentController extends Controller
{
    public function create(): View {
        session()->forget(['register_data', 'current_step']);

        $residents = Resident::all();

        return view('admins.residents', compact('residents'));
    }
}    
