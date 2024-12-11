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
use Illuminate\Support\Facades\DB;

class RegisteredResidentController extends Controller
{
    
    public function create(Request $request){
        $currentStep = session('current_step', 1);
        $householdDetails = null;
        if (session('register_data.household_action') === 'existing') {
            $householdId = session('register_data.existing_household_id');
            $householdDetails = Household::with('members')->find($householdId);
        }

        return view('auth.admin.resident.register', compact('currentStep', 'householdDetails'));
    }

    public function store(Request $request)
    {
        try {
            // Log incoming request data
            Log::info('Registration attempt:', $request->all());

            // Validate with detailed messages
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'last_name' => 'required|string|max:255',
                'sex' => 'required|string|max:50',
                'birthdate' => 'required|date',
                'age' => 'required|integer',
                'civil_status' => 'required|string|max:255',
                'contact_number' => 'required|string',
                'address' => 'required|string',
                'nationality' => 'required|string',
                'occupation' => 'required|string|max:255',
                'employer' => 'required|string|max:255',
                'educational_attainment' => 'required|string|max:255',
                'household_action' => 'required|string|in:new,existing',
                'new_household_name' => 'required_if:household_action,new',
                'existing_household_id' => 'required_if:household_action,existing',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                // Generate unique filename with original extension
                $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                // Store in public storage and save relative path to DB
                $imagePath = $file->storeAs('uploads/profile_images', $fileName, 'public');
                $validated['image'] = $imagePath; // This will be saved to DB
            }

            DB::beginTransaction();

            // Create Resident
            $resident = Resident::create([
                'identification_number' => $this->generateIdentificationNumber(),
                'image' => $validated['image'] ?? null,
                'first_name' => $validated['first_name'],
                'middle_name' => $validated['middle_name'],
                'last_name' => $validated['last_name'],
                'sex' => $validated['sex'],
                'birthdate' => $validated['birthdate'],
                'age' => $validated['age'],
                'civil_status' => $validated['civil_status'],
                'contact_number' => $validated['contact_number'],
                'address' => $validated['address'],
                'nationality' => $validated['nationality'],
                'occupation' => $validated['occupation'],
                'employer' => $validated['employer'],
                'educational_attainment' => $validated['educational_attainment'],
            ]);

            Log::info('Resident created:', $resident->toArray());

            // Create User
            $user = $this->createUserForResident($resident);
            Log::info('User created:', $user->toArray());

            // Handle Household
            if ($validated['household_action'] === 'new') {
                $household = Household::create([
                    'household_name' => $validated['new_household_name']
                ]);

                HouseholdMember::create([
                    'household_id' => $household->household_id,
                    'resident_id' => $resident->resident_id,
                    'is_head' => true
                ]);
            } elseif ($validated['household_action'] === 'existing') {
                HouseholdMember::create([
                    'household_id' => $validated['existing_household_id'],
                    'resident_id' => $resident->resident_id,
                    'is_head' => false
                ]);
            }

            // Handle Family Members
            if ($request->has('family_members')) {
                foreach ($request->family_members as $member) {
                    BloodRelation::create([
                        'related_to_resident_id' => $resident->resident_id,
                        'resident_id' => $member['resident_id'] ?? null,
                        'name' => $member['name'],
                        'relationship' => $member['relationship']
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('admin.residents')
                ->with('success', 'Resident registered successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Registration failed:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->withErrors(['error' => 'Registration failed: ' . $e->getMessage()]);
        }
    }

    protected function generateIdentificationNumber()
    {
        return rand(100000, 999999);
    }

    protected function createUserForResident($resident)
    {
        return User::create([
            'resident_id' => $resident->resident_id,
            'name' => $resident->first_name .  $resident->middle_name . $resident->last_name,
            'email' => strtolower($resident->first_name . '.' . $resident->last_name) . '@example.com',
            'password' => Hash::make('default_password'), // Replace with secure password
        ]);
    }
}
