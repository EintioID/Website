<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceAdvantage;
use Illuminate\Http\Request;

class ServiceAdvantageController extends Controller
{
    public function store(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $service->advantages()->create([
            'title' => $validated['title'],
            'order' => $service->advantages()->max('order') + 1,
        ]);

        return redirect()->route('admin.services.edit', $service)
            ->with('success', 'Keunggulan berhasil ditambahkan.')
            ->with('tab', 'keunggulan');
    }

    public function update(Request $request, Service $service, ServiceAdvantage $advantage)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $advantage->update($validated);

        return redirect()->route('admin.services.edit', $service)
            ->with('success', 'Keunggulan berhasil diperbarui.')
            ->with('tab', 'keunggulan');
    }

    public function destroy(Service $service, ServiceAdvantage $advantage)
    {
        $advantage->delete();

        return redirect()->route('admin.services.edit', $service)
            ->with('success', 'Keunggulan berhasil dihapus.')
            ->with('tab', 'keunggulan');
    }
}