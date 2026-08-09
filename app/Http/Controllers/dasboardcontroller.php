<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class dasboardcontroller extends Controller
{
    public function dashboard(Request $request)
    {
        return Inertia::render('Dashboard/Index', [

            'theme' => $request->cookie('theme', 'light'),

        ]);
    }
}
