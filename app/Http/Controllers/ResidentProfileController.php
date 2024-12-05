<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Resident;
use App\Models\BloodRelation;

class ResidentProfileController extends Controller
{
    public function create($resident): View {
        $resident = Resident::with(['relatedTo.Resident', 'householdMember.household.members.resident'])->findOrFail($resident);

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


    public function editRelationship(Request $request, $relation)
    {
        $relation = BloodRelation::findOrFail($relation);
        $relation->update($request->only('relationship'));
        return redirect()->back()->with('success', 'Relationship updated successfully.');
    }

    public function deleteRelationship($relation)
    {
        $relation = BloodRelation::findOrFail($relation);
        $relation->delete();
        return redirect()->back()->with('success', 'Relationship deleted successfully.');
    }

    public function storeRelationship(Request $request, $residentId) {
        $request->validate([
            'related_to_resident_id' => 'required|exists:residents, resident_id',
            'relationship' => 'required|string|max:255'
        ]);

        BloodRelation::create([
            'resident_id' => $residentId,
            'related_to_resident_id' => $request->input('related_to_resident_id'),
            'relationship' => $request->input('relationship'),
        ]); 

        return redirect()->back()->with('success', 'Relationship added successfully');
    }
}
