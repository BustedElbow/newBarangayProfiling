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
    
    public function update(Request $request, Resident $resident) {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'sex' => 'required|string|max:255',
            'civil_status' => 'required|string|max:255',
            'contact_number' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'occupation' => 'required|string|max:255',
            'employer' => 'required|string|max:255',
            'educational_attainment' => 'required|string|max:255'
        ]);

        $resident->update($validated);

        return redirect()->route('admin.resident.profile', $resident->resident_id);
    }

}
