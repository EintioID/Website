<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'tagline',
        'description',
        'vision',
        'mission',
        'logo',
        'favicon',
        'address',
        'phone',
        'email',
        'hero_badge',
        'hero_title',
        'hero_subtitle',
        'hero_image',
        'cta_1_label',
        'cta_1_url',
        'cta_2_label',
        'cta_2_url',
    ];
,
    protected $casts = [
        'mission' => 'array',
    ];
}