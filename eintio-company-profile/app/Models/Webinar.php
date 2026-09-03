<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webinar extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'type', 'short_description', 'description', 'speaker',
        'webinar_date', 'webinar_time', 'duration', 'platform', 'link',
        'quota', 'status', 'category', 'tags', 'thumbnail', 'is_published',
    ];

    protected $casts = [
        'webinar_date' => 'date',
        'is_published' => 'boolean',
    ];

    public function participants()
    {
        return $this->hasMany(WebinarParticipant::class);
    }
}