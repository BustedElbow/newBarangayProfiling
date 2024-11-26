<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ResidentProfileController extends Controller
{
    public function create(): View {
        return view('admins.residents');
    }   
}
