<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Category;

class PortfolioPublicController extends Controller
{
    public function index()
    {
        // Ambil semua kategori yang tersedia di Admin
        $categories = Category::orderBy('name')->get();

        // Hanya tampilkan portfolio yang statusnya published
        // dan ambil relasi category dari category_id
        $portfolios = Portfolio::with('category')
            ->where('status', 'published')
            ->latest('project_date')
            ->get();

        return view('portfolios.index', compact(
            'portfolios',
            'categories'
        ));
    }

    public function show(Portfolio $portfolio)
    {
        // Ambil kategori portfolio juga
        $portfolio->load('category');

        return view('portfolios.show', compact('portfolio'));
    }
}

