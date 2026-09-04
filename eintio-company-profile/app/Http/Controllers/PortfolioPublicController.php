<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;

class PortfolioPublicController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::where('status', 'published')
            ->latest('project_date')
            ->get();

        return view('portfolios.index', compact('portfolios'));
    }

    public function show(Portfolio $portfolio)
    {
        return view('portfolios.show', compact('portfolio'));
    }
}