<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogPublicController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::with(['category', 'author', 'sections'])
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());

        // Filter kategori
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Search
        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        // Artikel featured
        $featuredPost = (clone $query)
            ->where('featured', true)
            ->latest('published_at')
            ->first();

        // Kalau tidak ada featured, ambil artikel terbaru
        if (!$featuredPost) {
            $featuredPost = (clone $query)
                ->latest('published_at')
                ->first();
        }

        // Artikel terbaru
$blogPosts = $query
->latest('published_at')
->paginate(6)
->withQueryString();

return view('blog.index', compact(
'blogPosts',
'featuredPost'
));
    }

    public function show(BlogPost $blogPost)
    {
        abort_unless(
            $blogPost->is_published &&
            $blogPost->published_at &&
            $blogPost->published_at <= now(),
            404
        );
    
        $blogPost->load([
            'category',
            'author',
            'sections'
        ]);
    
        $publishedQuery = BlogPost::with(['category', 'author'])
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    
        $previousPost = (clone $publishedQuery)
            ->where('published_at', '<', $blogPost->published_at)
            ->latest('published_at')
            ->first();
    
        $nextPost = (clone $publishedQuery)
            ->where('published_at', '>', $blogPost->published_at)
            ->oldest('published_at')
            ->first();
    
        $relatedPosts = (clone $publishedQuery)
            ->whereKeyNot($blogPost->getKey())
            ->when($blogPost->category_id, function ($q) use ($blogPost) {
                $q->where('category_id', $blogPost->category_id);
            })
            ->latest('published_at')
            ->take(4)
            ->get();
    
        if ($relatedPosts->count() < 4) {
            $extra = (clone $publishedQuery)
                ->whereKeyNot($blogPost->getKey())
                ->whereNotIn('id', $relatedPosts->pluck('id'))
                ->latest('published_at')
                ->take(4 - $relatedPosts->count())
                ->get();
    
            $relatedPosts = $relatedPosts->concat($extra);
        }
    
        return view('blog.show', compact(
            'blogPost',
            'previousPost',
            'nextPost',
            'relatedPosts'
        ));
    }
    
}