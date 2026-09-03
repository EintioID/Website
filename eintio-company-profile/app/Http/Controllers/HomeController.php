<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the public homepage
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Display the company profile page
     */
    public function profile()
    {
        return view('profile');
    }
}