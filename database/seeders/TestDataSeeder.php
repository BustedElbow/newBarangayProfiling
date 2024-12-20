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
        // First Resident - Barangay Captain
        $resident1 = Resident::create([
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

        User::create([
            'resident_id' => $resident1->resident_id,
            'name' => "{$resident1->first_name} {$resident1->last_name}",
            'email' => 'juan@example.com',
            'password' => Hash::make('12345678'),
        ]);

        Official::create([
            'resident_id' => $resident1->resident_id,
            'position' => 'Barangay Captain',
            'term_start' => '2024-01-01',
            'term_end' => '2026-12-16',
            'is_active' => true,
        ]);

        // Second Resident - Barangay Secretary
        $resident2 = Resident::create([
            'identification_number' => rand(10000, 99999),
            'first_name' => 'Maria',
            'middle_name' => 'Santos',
            'last_name' => 'Garcia',
            'sex' => 'Female',
            'birthdate' => '1995-05-15',
            'age' => 29,
            'civil_status' => 'Single',
            'occupation' => 'Barangay Official',
            'educational_attainment' => 'College',
            'contact_number' => '09187654321',
            'address' => '456 School St, Barangay',
            'employer' => 'Barangay Office',
            'nationality' => 'Filipino'
        ]);

        User::create([
            'resident_id' => $resident2->resident_id,
            'name' => "{$resident2->first_name} {$resident2->last_name}",
            'email' => 'maria@example.com',
            'password' => Hash::make('12345678'),
        ]);

        Official::create([
            'resident_id' => $resident2->resident_id,
            'position' => 'Barangay Secretary',
            'term_start' => '2024-01-01',
            'term_end' => '2024-12-16',
            'is_active' => true,
        ]);
    }
}
