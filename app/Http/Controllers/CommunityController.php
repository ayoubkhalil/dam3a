<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class CommunityController extends Controller
{
    public function __invoke(): View
    {
        return view('communities.index');
    }
}
