<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogPostSection;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::query()->with(['author', 'category']);

        // ===== FILTER: Search =====
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // ===== FILTER: Kategori =====
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category_id', $request->category);
        }

        // ===== FILTER: Status =====
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('is_published', $request->status === 'published');
        }

        // ===== SORT =====
        switch ($request->get('sort', 'terbaru')) {
            case 'terlama':
                $query->orderBy('created_at', 'asc');
                break;
            case 'az':
                $query->orderBy('title', 'asc');
                break;
            case 'za':
                $query->orderBy('title', 'desc');
                break;
            case 'terbaru':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $blogPosts = $query->paginate(5)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('admin.blog-posts.index', compact('blogPosts', 'categories'));
    }

    public function create()
    {
        $authors = User::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('admin.blog-posts.create', compact('authors', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request, isCreate: true);
        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(5);
        $validated['featured'] = $request->boolean('featured');
        $validated['is_anonymous'] = $request->boolean('is_anonymous');

        if ($validated['is_anonymous']) {
            $validated['author_id'] = null;
        }

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('blog-posts', 'public');
        }

        $validated['is_published'] = $request->input('action') === 'publish';
        $validated['published_at'] = $validated['is_published']
            ? ($request->publish_type === 'schedule' ? $request->scheduled_at : now())
            : null;

        unset($validated['sections']);

        $blogPost = BlogPost::create($validated);

        $this->syncSections($request, $blogPost);

        $message = $validated['is_published']
            ? 'Artikel berhasil dipublikasikan.'
            : 'Artikel berhasil disimpan sebagai draft.';

        return redirect()->route('admin.blog-posts.index')->with('success', $message);
    }

    public function edit(BlogPost $blogPost)
    {
        $authors = User::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        $blogPost->load('sections');

        return view('admin.blog-posts.edit', compact('blogPost', 'authors', 'categories'));
    }

    public function update(Request $request, BlogPost $blogPost)
    {
        $validated = $this->validateData($request, isCreate: false);
        $validated['featured'] = $request->boolean('featured');
        $validated['is_anonymous'] = $request->boolean('is_anonymous');

        if ($validated['is_anonymous']) {
            $validated['author_id'] = null;
        }

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('blog-posts', 'public');
        }

        $validated['is_published'] = $request->input('action') === 'publish';
        $validated['published_at'] = $validated['is_published']
            ? ($blogPost->published_at ?? now())
            : null;

        unset($validated['sections']);

        $blogPost->update($validated);

        $this->syncSections($request, $blogPost);

        $message = $validated['is_published']
            ? 'Artikel berhasil dipublikasikan.'
            : 'Artikel berhasil disimpan sebagai draft.';

        return redirect()->route('admin.blog-posts.index')->with('success', $message);
    }

    public function destroy(BlogPost $blogPost)
    {
        $blogPost->sections()->delete();
        $blogPost->delete();

        return redirect()->route('admin.blog-posts.index')->with('success', 'Artikel berhasil dihapus.');
    }

    public function show(BlogPost $blogPost)
    {
        $blogPost->load('sections', 'author', 'category');

        return view('admin.blog-posts.show', compact('blogPost'));
    }

    private function validateData(Request $request, bool $isCreate = true): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'author_id' => $request->boolean('is_anonymous') ? 'nullable' : 'required|exists:users,id',
            'excerpt' => 'required|string|max:200',
            'thumbnail' => $isCreate ? 'required|image|max:2048' : 'nullable|image|max:2048',

            'sections' => 'nullable|array',
            'sections.*.type' => 'required|in:description,list,columns,benefits,timeline,quote',
            'sections.*.title' => 'required|string|max:255',
            'sections.*.badge' => 'nullable|string|max:50',
            'sections.*.data' => 'nullable|string',
        ]);
    }

    private function syncSections(Request $request, BlogPost $blogPost): void
    {
        $blogPost->sections()->delete();

        if ($request->filled('sections')) {
            foreach ($request->sections as $index => $sectionInput) {
                $blogPost->sections()->create([
                    'type'  => $sectionInput['type'],
                    'title' => $sectionInput['title'],
                    'badge' => $sectionInput['badge'] ?? null,
                    'data'  => json_decode($sectionInput['data'] ?? '{}', true) ?: [],
                    'order' => $index + 1,
                ]);
            }
        }
    }
}