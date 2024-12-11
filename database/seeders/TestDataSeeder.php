<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Resident;
use App\Models\User;
use App\Models\Official;
use Illuminate\Support\Facades\Hash;

class TestDataSeeder extends Seeder
{
    public function run()
    {
        // Create Resident
        $resident = Resident::create([
            'identification_number' => rand(10000, 99999),
            'first_name' => 'Juan',
            'middle_name' => 'Dela',
            'last_name' => 'Cruz',
            'sex' => 'Male',
            'birthdate' => '1990-01-01',
            'age' => 34,
            'civil_status' => 'Married',
            'occupation' => 'Barangay Official',
            'educational_attainment' => 'College',
            'contact_number' => '09123456789',
            'address' => '123 Main St, Barangay',
            'employer' => 'Barangay Office',
            'nationality' => 'Filipino'
        ]);

        // Create User Account with name
        User::create([
            'resident_id' => $resident->resident_id,
            'name' => "{$resident->first_name} {$resident->last_name}",
            'email' => 'juan@example.com',
            'password' => Hash::make('12345678'),
        ]);

        // Create Official Record
        Official::create([
            'resident_id' => $resident->resident_id,
            'position' => 'Barangay Captain',
            'term_start' => '2024-01-01',
            'term_end' => '2026-12-31',
            'is_active' => true,
        ]);
    }
}
