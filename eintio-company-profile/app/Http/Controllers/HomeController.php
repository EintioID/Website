<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\CoreValue;
use App\Models\Portfolio;

class HomeController extends Controller
{
    /**
     * Display the public homepage
     */
    public function index()
    {
        $portfolios = Portfolio::with('category')
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get();

        return view('index', compact('portfolios'));
    }

    public function profile()
    {
        $profile = Profile::first() ?? new Profile();

        $coreValues = CoreValue::orderBy('id')->get();

        return view('profile', compact('profile', 'coreValues'));
    }
}