<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BrgyClearance;
use App\Models\Official;
use Illuminate\Support\Facades\Log;

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
        $pendingClearances = BrgyClearance::with('resident')
        ->where('status', 'pending')
        ->latest('request_date')
        ->get();

        $processedClearances = BrgyClearance::with('resident')
        ->whereIn('status', ['approved', 'for_claim', 'claimed', 'rejected'])
        ->latest('request_date')
        ->get();

        return view('admins.clearances', compact('pendingClearances', 'processedClearances'));
    }

    public function updateStatus(Request $request, BrgyClearance $clearance)
    {
        try {
            $validated = $request->validate([
                'status' => 'required|in:approve,for_claim,claimed,reject'
            ]);

            $status = match ($validated['status']) {
                'approve' => 'approved',
                'for_claim' => 'for_claim',
                'claimed' => 'claimed',
                'reject' => 'rejected',
            };

            $clearance->update(['status' => $status]);

            return response()->json([
                'success' => true,
                'message' => 'Clearance status updated successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Clearance update failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update clearance status'
            ], 500);
        }
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
