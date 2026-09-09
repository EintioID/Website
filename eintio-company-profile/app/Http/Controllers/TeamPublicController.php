<?php

namespace App\Http\Controllers;

use App\Models\Team;

class TeamPublicController extends Controller
{
    public function index()
    {
        $members = Team::with('division')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('teams.index', compact('members'));
    }
}