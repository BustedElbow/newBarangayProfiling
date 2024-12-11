<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Official;

class HomeController extends Controller
{
    public function index()
    {
        $officials = Official::with('resident')
        ->where('is_active', true)
            ->orderBy('position')
            ->get();

        return view('residents.home', compact('officials'));
    }
}
