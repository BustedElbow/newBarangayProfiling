<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Household;

class HouseHoldController extends Controller
{
    public function fetchHouseholds(Request $request) {
        $search = $request->input('search');

        $households = Household::query()
        ->with(['members' => function ($query) {
            $query->where('is_head', true)->with('resident');
        }])
        ->where('household_name', 'like', '%' . $search . '%')
        ->get();

        return response()->json($households);
    }

    public function create(): View {
        $households = Household::all();

        return view('admins.households', compact('households'));
    }

    public function show(Household $household)
    {
        $household->load(['members.resident']);
        return view('admins.household-profile', compact('household'));
    }
}
