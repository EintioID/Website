<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Category;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $divisions = Category::orderBy('name')->get();

        $sort = $request->input('sort', 'urutan');

        $query = Team::with('division')
            ->when($request->search, function ($q) use ($request) {
                $q->where(function ($sub) use ($request) {
                    $sub->where('name', 'like', '%'.$request->search.'%')
                        ->orWhere('position', 'like', '%'.$request->search.'%');
                });
            })
            ->when($request->division_id, fn($q) => $q->where('division_id', $request->division_id));

        match ($sort) {
            'terbaru' => $query->orderBy('created_at', 'desc'),
            'terlama' => $query->orderBy('created_at', 'asc'),
            'nama_az' => $query->orderBy('name', 'asc'),
            'nama_za' => $query->orderBy('name', 'desc'),
            default   => $query->orderBy('order', 'asc')->orderBy('created_at', 'desc'),
        };

        $members = $query->paginate(15)->withQueryString();

        return view('admin.teams.index', compact('members', 'divisions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil divisi untuk dropdown saat create
        $divisions = Category::all();
        
        return view('admin.teams.create', compact('divisions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'division_id' => 'nullable|exists:categories,id',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'linkedin' => 'nullable|url',
            'instagram' => 'nullable|url',
        ]);

        $data = $request->only(
            'name',
            'position',
            'division_id',
            'bio',
            'order',
            'is_active',
            'linkedin',
            'instagram'
        );

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('teams', 'public');
        }

        if (!isset($data['is_active'])) {
            $data['is_active'] = true;
        }

        Team::create($data);

        return redirect()
            ->route('admin.teams.index')
            ->with('success', 'Anggota tim berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        $divisions = Category::all();

        return view('admin.teams.edit', compact('team', 'divisions'))
            ->with('teams', $team);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'division_id' => 'nullable|exists:categories,id',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'linkedin' => 'nullable|url',
            'instagram' => 'nullable|url',
        ]);

        $data = $request->only(
            'name',
            'position',
            'division_id',
            'bio',
            'order',
            'is_active',
            'linkedin',
            'instagram'
        );

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('teams', 'public');
        }

        if (!isset($data['is_active'])) {
            $data['is_active'] = false;
        } else {
            $data['is_active'] = (bool) $data['is_active'];
        }

        $team->update($data);

        return redirect()
            ->route('admin.teams.index')
            ->with('success', 'Anggota tim berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        $team->delete();

        return redirect()
            ->route('admin.teams.index')
            ->with('success', 'Anggota tim berhasil dihapus');
    }
}