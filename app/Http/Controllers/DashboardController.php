<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get resident statistics
        $genderStats = Resident::select('sex', DB::raw('count(*) as count'))
        ->groupBy('sex')
        ->get();

        $ageStats = Resident::select(
            DB::raw("CASE 
            WHEN age < 18 THEN 'Under 18'
            WHEN age BETWEEN 18 AND 30 THEN '18-30'
            WHEN age BETWEEN 31 AND 50 THEN '31-50'
            ELSE 'Over 50'
        END as age_group"),
            DB::raw('count(*) as count')
        )
        ->groupBy('age_group')
        ->get();

        $civilStatusStats = Resident::select('civil_status', DB::raw('count(*) as count'))
        ->groupBy('civil_status')
        ->get();

        $educationStats = Resident::select('educational_attainment', DB::raw('count(*) as count'))
        ->groupBy('educational_attainment')
        ->get();

        return view('admins.dashboard', compact('genderStats', 'ageStats', 'civilStatusStats', 'educationStats'));
    }
}
