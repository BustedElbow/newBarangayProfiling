<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Resident;
use App\Models\User;
use App\Models\BloodRelation;
use App\Models\Household;
use App\Models\HouseholdMember;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisteredResidentController extends Controller
{
    
    public function create(Request $request){
        $currentStep = session('current_step', 1);
        return view('auth.admin.resident.register', compact('currentStep'));
    }

    public function handleForm(Request $request)
    {
        $currentStep = session('current_step', 1);

        if ($request->has('previousForm') && $request->previousForm === 'previous') {
            $currentStep = max(1, $currentStep - 1);
        } else {
            $this->validateStep($request, $currentStep);
            $this->storeRegisterSession($request, $currentStep);
            if ($currentStep > 0 && $currentStep < 4) {
                $currentStep = $currentStep + 1;
            }
        }

        session(['current_step' => $currentStep]);

        if ($request->has('submit')) {
            return $this->store($request);
        }

        return redirect()->route('admin.resident.register');
    }


    private function validateStep(Request $request, $step)
    {
        $rules = [];


        if ($step == 1) {
            $rules = [
                'first_name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'last_name' => 'required|string|max:255',
                'image' => 'nullable|string|max:255',
                'civil_status' => 'required|string|max:255',
                'sex' => 'required|string|max:50',
                'birthdate' => 'required|date',
                'address' => 'required|string',
                'contact_number' => 'required|string',
                'nationality' => 'required|string',
            ];
        }

        if ($step == 2) {
            $rules = [
                'household_action' => 'required|string|in:new,existing',
                'new_household_name' => 'required_if:household_action,new|string|max:255',
                'existing_household_id' => 'required_if:household_action,existing|exists:households,id',
                'family_members' => 'array',
                'family_members.*.name' => 'required|string|max:255',
                'family_members.*.relationship' => 'required|string|max:255',
                'family_members.*.resident_id' => 'nullable|exists:residents,resident_id',
            ];
        }

        if ($step == 3) {
            $rules = [
                'occupation' => 'required|string|max:255',
                'employer' => 'required|string|max:255',
                'educational_attainment' => 'required|string|max:255',
                'health_conditions' => 'nullable|string',
            ];
        }

        $request->validate($rules);
    }

    private function storeRegisterSession(Request $request, $step)
    {
        if ($step == 1) {
            session([
                'register_data.first_name' => $request->first_name,
                'register_data.middle_name' => $request->middle_name,
                'register_data.last_name' => $request->last_name,
                'register_data.civil_status' => $request->civil_status,
                'register_data.sex' => $request->sex,
                'register_data.contact_number' => $request->contact_number,
                'register_data.birthdate' => $request->birthdate,
                'register_data.age' => $request->age,
                'register_data.address' => $request->address,
                'register_data.nationality' => $request->nationality
            ]);
        }

        if ($step == 2) {
            $familyMembers = $request->input('family_members', []);
            session([
                'register_data.household_action' => $request->household_action,
                'register_data.new_household_name' => $request->new_household_name,
                'register_data.existing_household_id' => $request->existing_household_id,
                'register_data.family_members' => $familyMembers,
            ]);

        }

        if ($step == 3) {
            session([
                'register_data.occupation' => $request->occupation,
                'register_data.employer' => $request->employer,
                'register_data.educational_attainment' => $request->educational_attainment,
            ]);
        }
    }

    public function store(Request $request)
    {
        $residentData = session('register_data');

        $residentData['identification_number'] = $this->generateIdentificationNumber();

        $resident = Resident::create($residentData);

        $this->createUserForResident($resident);


        if ($residentData['household_action'] === 'new') {
            $household = Household::create([
                'household_name' => $residentData['new_household_name'],
            ]);

            // dd($household->toArray());

            Log::info('Household created', ['household_id' => $household->household_id]);

            HouseholdMember::create([
                'household_id' => $household->household_id,
                'resident_id'=> $resident->resident_id,
                'is_head' => true,
            ]);
        } elseif ($residentData['household_action'] === 'existing') {
            $householdId = $residentData['existing_household_id'];
            HouseholdMember::create([
                'household_id' => $householdId,
                'resident_id' => $resident->resident_id,
                'is_head' => false,
            ]);
        }


        if (!empty($residentData['family_members'])) {
            foreach ($residentData['family_members'] as $familyMember) {
                // If the frontend already provides the resident_id, use it
                $linkedResidentId = $familyMember['resident_id'] ?? null;

                BloodRelation::create([
                    'related_to_resident_id' => $resident->resident_id,
                    'name' => $familyMember['name'], 
                    'relationship' => $familyMember['relationship'],
                    'resident_id' => $linkedResidentId, 
                ]);
            }
        }


        // Reset session data
        session()->forget(['register_data', 'currentStep']);

        return redirect()->route('admin.residents');
    }

    protected function generateIdentificationNumber()
    {
        return rand(100000, 999999);
    }

    protected function createUserForResident($resident)
    {
        User::create([
            'resident_id' => $resident->resident_id,
            'name' => $resident->first_name .  $resident->middle_name . $resident->last_name,
            'email' => strtolower($resident->first_name . '.' . $resident->last_name) . '@example.com',
            'password' => Hash::make('default_password'), // Replace with secure password
            'role' => 'resident',
        ]);
    }
}
