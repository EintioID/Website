<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Team extends Model
{
    protected $fillable = [
        'name',
        'position',
        'division_id',
        'bio',
        'photo',
        'order',
        'is_active',
        'linkedin',
        'instagram',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi dengan Category (Divisi)
     */
    public function division(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'division_id');
    }
}