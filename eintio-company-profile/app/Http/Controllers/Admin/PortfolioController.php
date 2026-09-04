<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $portfolios = Portfolio::with('category')
            ->when($request->search, fn($q) => $q->where('title', 'like', '%' . $request->search . '%'))
            ->when($request->category_id, fn($q) => $q->where('category_id', $request->category_id))
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->orderBy('order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->withQueryString();

        return view('admin.portfolios.index', compact('portfolios', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.portfolios.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);
        $data = $this->prepareData($request, $validated);

        $data['slug'] = $this->generateSlug($data['title']);

        Portfolio::create($data);

        return redirect()
            ->route('admin.portfolios.index')
            ->with('success', 'Portofolio berhasil ditambahkan');
    }

    public function edit(Portfolio $portfolio)
    {
        $categories = Category::all();

        return view('admin.portfolios.edit', compact('portfolio', 'categories'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $validated = $this->validateData($request);
        $data = $this->prepareData($request, $validated, $portfolio);

        if ($data['title'] !== $portfolio->title) {
            $data['slug'] = $this->generateSlug($data['title'], $portfolio->id);
        }

        $portfolio->update($data);

        return redirect()
            ->route('admin.portfolios.index')
            ->with('success', 'Portofolio berhasil diperbarui');
    }

    public function destroy(Portfolio $portfolio)
    {
        // Hapus semua file terkait sebelum hapus record
        if ($portfolio->image) {
            Storage::disk('public')->delete($portfolio->image);
        }
        if ($portfolio->gallery) {
            foreach ($portfolio->gallery as $path) {
                Storage::disk('public')->delete($path);
            }
        }

        $portfolio->delete();

        return redirect()
            ->route('admin.portfolios.index')
            ->with('success', 'Portofolio berhasil dihapus');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'title'             => 'required|string|max:255',
            'description'       => 'nullable|string|max:500',
            'category_id'       => 'nullable|exists:categories,id',
            'client'            => 'nullable|string|max:255',
            'project_date'      => 'nullable|date',
            'status'            => 'required|in:draft,published',
            'image'             => 'nullable|image|max:2048',
            'background'        => 'nullable|string',
            'requirements'      => 'nullable|array',
            'requirements.*'    => 'nullable|string|max:255',
            'solutions'         => 'nullable|array',
            'solutions.*.icon'  => 'nullable|string|max:100',
            'solutions.*.title' => 'nullable|string|max:100',
            'solutions.*.description' => 'nullable|string|max:255',
            'keep_gallery'      => 'nullable|array',
            'keep_gallery.*'    => 'nullable|string',
            'gallery.*'         => 'nullable|image|max:2048',
        ]);
    }

    private function prepareData(Request $request, array $validated, ?Portfolio $portfolio = null): array
    {
        $data = collect($validated)->except(['image', 'gallery', 'keep_gallery'])->toArray();

        if (!empty($data['requirements'])) {
            $data['requirements'] = array_values(array_filter($data['requirements']));
        }

        if (!empty($data['solutions'])) {
            $data['solutions'] = array_values(array_filter($data['solutions'], fn($s) => !empty($s['title'])));
        }

        if ($request->hasFile('image')) {
            if ($portfolio && $portfolio->image) {
                Storage::disk('public')->delete($portfolio->image);
            }
            $data['image'] = $request->file('image')->store('portfolios/thumbnails', 'public');
        }

        // ===== GALERI: kelola gambar lama yang dipertahankan + gambar baru =====
        $keptGallery = $request->input('keep_gallery', []);

       
        if ($portfolio && $portfolio->gallery) {
            $removed = array_diff($portfolio->gallery, $keptGallery);
            foreach ($removed as $path) {
                Storage::disk('public')->delete($path);
            }
        }

        // Upload gambar galeri baru
        $newUploads = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $newUploads[] = $file->store('portfolios/gallery', 'public');
            }
        }

        $data['gallery'] = array_values(array_merge($keptGallery, $newUploads));

        return $data;
    }

    private function generateSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $i = 1;

        while (Portfolio::where('slug', $slug)->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $original . '-' . $i++;
        }

        return $slug;
    }
}