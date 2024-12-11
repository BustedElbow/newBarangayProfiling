<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BrgyClearance;
use App\Models\Official;

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

        return view('admins.clearances', compact('clearances'));
    }

    public function approve(BrgyClearance $clearance)
    {
        // Get the official record from authenticated user
        $official = Official::where('resident_id', auth()->user()->resident->resident_id)
            ->where('is_active', true)
            ->first();

        if (!$official) {
            return response()->json([
                'success' => false,
                'message' => 'Only active officials can approve clearances'
            ], 403);
        }

        $clearance->update([
            'status' => 'approved',
            'processed_by' => $official->official_id, // Use official_id instead of user id
            'processed_date' => now()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Clearance approved successfully'
        ]);
    }

    public function markForClaim(BrgyClearance $clearance)
    {
        $clearance->update(['status' => 'for_claim']);
        return response()->json(['success' => true]);
    }

    public function markAsClaimed(BrgyClearance $clearance)
    {
        $clearance->update(['status' => 'claimed']);
        return response()->json(['success' => true]);
    }
}
