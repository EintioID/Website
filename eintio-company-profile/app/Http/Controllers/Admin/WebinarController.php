<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Webinar;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WebinarController extends Controller
{
    public function index(Request $request)
{
    $webinars = Webinar::query()
        ->when($request->search, fn ($q) => $q->where('title', 'like', "%{$request->search}%"))
        ->when($request->status && $request->status !== 'all', fn ($q) => $q->where('status', $request->status))
        ->when($request->type && $request->type !== 'all', fn ($q) => $q->where('type', $request->type))
        ->withCount('participants')
        ->latest('webinar_date')
        ->paginate(3);

    return view('admin.webinars.index', compact('webinars'));
}

    public function create()
    {
        return view('admin.webinars.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:live,recorded',
            'short_description' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'webinar_date' => 'required|date',
            'webinar_time' => 'required|string',
            'duration' => 'nullable|string',
            'platform' => 'nullable|string',
            'link' => 'nullable|url',
            'quota' => 'nullable|integer',
            'status' => 'required|in:draft,scheduled,published',
            'category' => 'nullable|string',
            'tags' => 'nullable|string',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(5);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('webinars', 'public');
        }

        Webinar::create($validated);

        return redirect()->route('admin.webinars.index')->with('success', 'Webinar berhasil ditambahkan.');
    }

    public function edit(Webinar $webinar)
    {
        return view('admin.webinars.edit', compact('webinar'));
    }

    public function update(Request $request, Webinar $webinar)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:live,recorded',
            'short_description' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'webinar_date' => 'required|date',
            'webinar_time' => 'required|string',
            'duration' => 'nullable|string',
            'platform' => 'nullable|string',
            'link' => 'nullable|url',
            'quota' => 'nullable|integer',
            'status' => 'required|in:draft,scheduled,published',
            'category' => 'nullable|string',
            'tags' => 'nullable|string',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('webinars', 'public');
        }

        $webinar->update($validated);

        return redirect()->route('admin.webinars.index')->with('success', 'Webinar berhasil diperbarui.');
    }

    public function destroy(Webinar $webinar)
    {
        $webinar->delete();

        return redirect()->route('admin.webinars.index')->with('success', 'Webinar berhasil dihapus.');
    }

    public function show(Webinar $webinar)
    {
        return view('admin.webinars.show', compact('webinar'));
    }
}