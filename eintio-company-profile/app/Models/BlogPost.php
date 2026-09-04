<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'author_id', 'title', 'slug', 'content',
        'excerpt', 'thumbnail', 'is_published', 'is_anonymous', 'featured', 'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_anonymous' => 'boolean',
        'featured' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function sections()
    {
        return $this->hasMany(BlogPostSection::class)->orderBy('order');
    }
}