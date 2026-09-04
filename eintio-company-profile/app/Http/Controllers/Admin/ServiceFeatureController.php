<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceFeature;
use Illuminate\Http\Request;

class ServiceFeatureController extends Controller
{
    public function store(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:160',
            'icon' => 'required|string|max:100',
        ]);

        $validated['order'] = $service->features()->max('order') + 1;

        $service->features()->create($validated);

        return back()
            ->with('success', 'Fitur layanan berhasil ditambahkan.')
            ->with('tab', 'fitur');
    }

    public function update(Request $request, Service $service, ServiceFeature $feature)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:160',
            'icon' => 'required|string|max:100',
        ]);

        $feature->update($validated);

        return back()
            ->with('success', 'Fitur layanan berhasil diperbarui.')
            ->with('tab', 'fitur');
    }

    public function destroy(Service $service, ServiceFeature $feature)
    {
        $feature->delete();

        return back()
            ->with('success', 'Fitur layanan berhasil dihapus.')
            ->with('tab', 'fitur');
    }
}