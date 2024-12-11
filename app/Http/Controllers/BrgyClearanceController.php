<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BrgyClearance;

class BrgyClearanceController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'purpose' => 'required|string|max:255',
        ]);

        $clearance = BrgyClearance::create([
            'resident_id' => auth()->user()->resident->resident_id,
            'request_date' => now(),
            'purpose' => $validated['purpose'],
            'status' => 'pending'
        ]);

        return back()->with('success', 'Clearance request submitted successfully.');
    }

    public function index()
    {
        $clearances = BrgyClearance::with('resident')
        ->latest('request_date')
        ->get();

        return view('admins.services', compact('clearances'));
    }
}
