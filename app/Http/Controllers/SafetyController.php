<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class SafetyController extends Controller
{
    public function index(): View
    {
        return view('safety.index');
    }
}
