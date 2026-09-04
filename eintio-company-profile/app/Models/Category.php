<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi dengan Team
     */
    public function teams(): HasMany
    {
        return $this->hasMany(Team::class, 'division_id');
    }

    /**
     * Relasi dengan BlogPost
     */
    public function blogPosts(): HasMany
    {
        return $this->hasMany(BlogPost::class);
    }
}