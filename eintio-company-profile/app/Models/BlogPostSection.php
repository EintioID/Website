<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPostSection extends Model
{
    protected $fillable = [
        'blog_post_id',
        'type',
        'badge',
        'title',
        'content',
        'data',
        'order',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class);
    }
}