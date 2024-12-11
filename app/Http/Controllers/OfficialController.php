<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Official;


class OfficialController extends Controller
{
    public function create(): View {
        $officials = Official::with('resident')->get();
        return view('admins.officials', compact('officials'));
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
}
