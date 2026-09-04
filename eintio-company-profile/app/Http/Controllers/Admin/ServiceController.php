<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    protected array $categories = ['Teknologi', 'Akademik', 'Bisnis', 'Lainnya'];

    public function index(Request $request)
{
    $query = Service::query();

    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('category') && $request->category !== 'all') {
        $query->where('category', $request->category);
    }

    if ($request->filled('status') && $request->status !== 'all') {
        $query->where('status', $request->status);
    }

    $sort = $request->get('sort', 'urutan');

    switch ($sort) {
        case 'terbaru':
            $query->orderBy('created_at', 'desc');
            break;
        case 'terlama':
            $query->orderBy('created_at', 'asc');
            break;
        case 'nama_az':
            $query->orderBy('name', 'asc');
            break;
        case 'nama_za':
            $query->orderBy('name', 'desc');
            break;
        default:
            $query->orderBy('order', 'asc');
            break;
    }

    $services = $query->paginate(10)->withQueryString();

    return view('admin.services.index', [
        'services' => $services,
        'categories' => $this->categories,
    ]);
}

    public function create()
    {
        return view('admin.services.create', ['categories' => $this->categories]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'icon' => 'nullable|image|max:2048',
            'short_description' => 'required|string|max:500',
        ]);

        $validated['slug'] = Str::slug($validated['name']) . '-' . uniqid();
        $validated['status'] = 'aktif';
        $validated['order'] = Service::max('order') + 1;

        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->store('services', 'public');
        }

        $service = Service::create($validated);

        return redirect()->route('admin.services.edit', $service)
            ->with('success', 'Layanan berhasil dibuat. Lanjutkan isi Keunggulan & Fitur.')
            ->with('tab', 'keunggulan');
    }

    public function edit(Service $service)
    {
        $service->load('advantages', 'features');

        return view('admin.services.edit', [
            'service' => $service,
            'categories' => $this->categories,
        ]);
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'icon' => 'nullable|image|max:2048',
            'short_description' => 'required|string|max:500',
            'status' => 'nullable|in:aktif,nonaktif',
        ]);

        $validated['status'] = $request->status ?? $service->status;

        if ($request->hasFile('icon')) {
            if ($service->icon) {
                Storage::disk('public')->delete($service->icon);
            }
            $validated['icon'] = $request->file('icon')->store('services', 'public');
        }

        $service->update($validated);

        return back()->with('success', 'Informasi layanan berhasil diperbarui.');
    }

    public function destroy(Service $service)
    {
        if ($service->icon) {
            Storage::disk('public')->delete($service->icon);
        }

        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil dihapus.');
    }

    public function complete(Service $service)
    {
        $service->update(['is_completed' => true]);

        return redirect()->route('admin.services.index')
            ->with('success', 'Layanan berhasil disimpan.');
    }
}