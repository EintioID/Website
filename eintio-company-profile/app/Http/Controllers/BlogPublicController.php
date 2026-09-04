<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;

class BlogPublicController extends Controller
{
    public function index()
    {
        $posts = BlogPost::latest()->get();

        return view('blog.index', compact('posts'));
    }

    public function show(BlogPost $blogPost)
    {
        return view('blog.show', compact('blogPost'));
    }
}