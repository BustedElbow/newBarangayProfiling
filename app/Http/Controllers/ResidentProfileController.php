<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Resident;

class ResidentProfileController extends Controller
{
    public function create($resident): View {
        $resident= Resident::findOrFail($resident);

        return view('admins.resident-profile', compact('resident'));
    }   
}
