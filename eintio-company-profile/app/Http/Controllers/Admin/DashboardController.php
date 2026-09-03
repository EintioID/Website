<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\BlogPost;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function index()
{
    $stats = [
        'services'     => class_exists(Service::class) ? Service::count() : 0,
        'portfolios'   => class_exists(Portfolio::class) ? Portfolio::count() : 0,
        'blog_posts'   => class_exists(BlogPost::class) ? BlogPost::count() : 0,
        'testimonials' => class_exists(Testimonial::class) ? Testimonial::count() : 0,
    ];

    // Kosong dulu (semua 0) sampai ada data pesan/artikel per bulan yang bisa dihitung
    $chartPesan = array_fill(0, 12, 0);
    $chartArtikel = array_fill(0, 12, 0);

    $activities = collect();
    $notifications = collect();

    return view('admin.dashboard', compact('stats', 'chartPesan', 'chartArtikel', 'activities', 'notifications'));
}
}