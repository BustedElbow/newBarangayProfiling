<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Resident;
use App\Models\BloodRelation;
use App\Models\HouseholdMember;
use Illuminate\Support\Facades\Log;

class ResidentProfileController extends Controller
{
    public function create(int $residentId): View
    {
        $residentData = Resident::with([
            'relatedTo.Resident',
            'householdMember.household.members.resident'
        ])->findOrFail($residentId);
        

        return view('admins.resident-profile', compact('residentData'));
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

        $validated = $request->validate([
            'relationship' => 'required|string|max:255'
        ]);

        $relation->update([
            'relationship' => $validated['relationship']
        ]);

        return redirect()->back()->with('success', 'Relationship edited successfully.');
    }

    public function deleteRelationship($relation)
    {
        $relation = BloodRelation::findOrFail($relation);
        $relation->delete();
        return redirect()->back()->with('success', 'Relationship deleted successfully.');
    }

    public function storeRelationship(Request $request, $residentId)
    {
        $request->validate([
            'relationships' => 'required|array',
            'relationships.*.resident_id' => 'nullable|exists:residents,resident_id',
            'relationships.*.name' => 'required|string|max:255',
            'relationships.*.relationship' => 'required|string|max:255'
        ]);

        foreach ($request->relationships as $relationship) {
            BloodRelation::create([
                'resident_id' => $relationship['resident_id'],
                'related_to_resident_id' => $residentId,
                'name' => $relationship['name'],
                'relationship' => $relationship['relationship']
            ]);
        }

        return redirect()->back()->with('success', 'Relationships added successfully');
    }

    public function updateHousehold(Request $request, Resident $resident)
    {
        try {
            $request->validate([
                'household_id' => 'required|exists:households,household_id',
            ]);

            $householdMember = HouseholdMember::updateOrCreate(
                ['resident_id' => $resident->resident_id],
                [
                    'household_id' => $request->household_id,
                    'is_head' => false
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'Household updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update household',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function leaveHousehold(Resident $resident)
    {
        try {
            $householdMember = HouseholdMember::where('resident_id', $resident->resident_id)->first();

            if (!$householdMember) {
                return response()->json([
                    'success' => false,
                    'message' => 'Resident is not in any household'
                ], 404);
            }

            if ($householdMember->is_head) {
                return response()->json([
                    'success' => false,
                    'message' => 'Household head cannot leave the household'
                ], 400);
            }

            // Delete using the correct primary key
            HouseholdMember::where('household_mem_id', $householdMember->household_mem_id)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Successfully left household'
            ]);
        } catch (\Exception $e) {
            Log::error('Leave household error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to leave household: ' . $e->getMessage()
            ], 500);
        }
    }
}
