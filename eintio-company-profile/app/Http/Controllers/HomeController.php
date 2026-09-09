<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\CoreValue;

class HomeController extends Controller
{
    /**
     * Display the public homepage
     */
    public function index()
    {
        return view('index');
    }

    public function profile()
{
    $profile = Profile::first() ?? new Profile();

    $coreValues = CoreValue::orderBy('id')->get();

    return view('profile', compact('profile', 'coreValues'));
}
}