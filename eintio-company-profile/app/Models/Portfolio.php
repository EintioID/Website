<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'category_id',
        'client',
        'project_date',
        'status',
        'image',
        'background',
        'requirements',
        'solutions',
        'gallery',
        'order',
    ];

    protected $casts = [
        'requirements' => 'array',
        'solutions'    => 'array',
        'gallery'      => 'array',
        'project_date' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}