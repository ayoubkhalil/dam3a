<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class LearnController extends Controller
{
    public function index(): View
    {
        return view('learn.index');
    }
}
