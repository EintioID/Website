<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function index()
    {
        $blogPosts = BlogPost::with('category')->latest()->get();
        return view('admin.blog-posts.index', compact('blogPosts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.blog-posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'thumbnail' => 'nullable|image|max:2048',
            'is_published' => 'nullable|boolean',
        ]);

        $data = $request->only('title', 'content', 'category_id');
        $data['slug'] = Str::slug($request->title) . '-' . uniqid();
        $data['is_published'] = $request->has('is_published');
        $data['published_at'] = $data['is_published'] ? now() : null;

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('blog', 'public');
        }

        BlogPost::create($data);

        return redirect()->route('admin.blog-posts.index')->with('success', 'Artikel berhasil ditambahkan');
    }

    public function edit(BlogPost $blogPost)
    {
        $categories = Category::all();
        return view('admin.blog-posts.edit', compact('blogPost', 'categories'));
    }

    public function update(Request $request, BlogPost $blogPost)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'thumbnail' => 'nullable|image|max:2048',
            'is_published' => 'nullable|boolean',
        ]);

        $data = $request->only('title', 'content', 'category_id');
        $data['is_published'] = $request->has('is_published');
        $data['published_at'] = $data['is_published'] ? ($blogPost->published_at ?? now()) : null;

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('blog', 'public');
        }

        $blogPost->update($data);

        return redirect()->route('admin.blog-posts.index')->with('success', 'Artikel berhasil diperbarui');
    }

    public function destroy(BlogPost $blogPost)
    {
        $blogPost->delete();
        return redirect()->route('admin.blog-posts.index')->with('success', 'Artikel berhasil dihapus');
    }
}