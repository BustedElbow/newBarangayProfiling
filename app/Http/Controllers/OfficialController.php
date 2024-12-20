<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Official;
use App\Models\purok;
use App\Models\Resident;


class OfficialController extends Controller
{
    public function create(): View {
        $officials = Official::with('resident')->get();
        $puroks = purok::with('leader')->get();
        $residents = Resident::all();
        $activeOfficials = $officials->filter(function ($official) {
            return !$official->isTermEnded();
        });

        $archivedOfficials = $officials->filter(function ($official) {
            return $official->isTermEnded();
        });

        return view('admins.officials', compact('officials', 'puroks', 'residents', 'activeOfficials', 'archivedOfficials'));
    }

    public function store(Request $request) {
        try {
            $validated = $request->validate([
                'resident_id' => 'required|exists:residents,resident_id',
                'position' => 'required|string|max:255',
                'term_start' => 'required|date',
                'term_end' => 'required|date|after:term_start',
            ]);

            Official::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Official added successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add official: ' . $e->getMessage()
            ], 500);
        }
    }

    public function storePurok(Request $request)
    {
        try {
            $validated = $request->validate([
                'purok_name' => 'required|string|max:255',
                'purok_leader' => 'required|exists:residents,resident_id'
            ]);

            Purok::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Purok added successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function updatePurok(Request $request, Purok $purok)
    {
        try {
            $validated = $request->validate([
                'purok_name' => 'required|string|max:255',
                'purok_leader' => 'required|exists:residents,resident_id'
            ]);

            $purok->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Purok updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
