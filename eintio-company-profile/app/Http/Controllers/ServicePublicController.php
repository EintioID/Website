<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
class ServicePublicController extends Controller
{
    public function index()
    {
        $services = Service::latest()->get();
        return view('layanan', compact('services'));
    }

    public function show(Service $service)
    {
        return view('layanan-detail', compact('service'));
    }
}