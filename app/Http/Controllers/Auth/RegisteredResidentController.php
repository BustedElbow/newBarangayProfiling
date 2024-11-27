<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Resident;
use App\Models\User;
use App\Models\BloodRelation;
use Illuminate\Support\Facades\Hash;

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

            //Log::info('Stored session data:', session()->all());
        }

        if ($step == 2) {
            $familyMembers = $request->input('family_members', []);
            session(['register_data.family_members' => $familyMembers]);

            // Log::info('Family members stored in session:', ['family_members' => $familyMembers]);
            // Log::info('Complete register_data in session:', session('register_data'));
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

        // Generate identification number
        $residentData['identification_number'] = $this->generateIdentificationNumber();

        // Store resident data in the database
        $resident = Resident::create($residentData);

        //Log::info('Created Resident:', ['resident' => $resident]);

        // Create a user for the resident
        $this->createUserForResident($resident);

        if (!empty($residentData['family_members'])) {
            foreach ($residentData['family_members'] as $familyMember) {
                // If the frontend already provides the resident_id, use it
                $linkedResidentId = $familyMember['resident_id'] ?? null;

                // Fallback: If not provided, search in the database
                // if (!$linkedResidentId) {
                //     $existingResident = Resident::where('first_name', $familyMember['name'])
                //     ->orWhere('last_name', $familyMember['name'])
                //     ->first();
                //     $linkedResidentId = $existingResident ? $existingResident->resident_id : null;
                // }

                BloodRelation::create([
                    'related_to_resident_id' => $resident->resident_id, // Current resident's ID
                    'name' => $familyMember['name'], // Entered family member's name
                    'relationship' => $familyMember['relationship'], // Provided relationship
                    'resident_id' => $linkedResidentId, // Use the linked resident_id
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
