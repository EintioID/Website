<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
    'name',
    'slug',
    'category',
    'icon',
    'short_description',
    'status',
    'order',
    'is_completed',
];

public function advantages()
{
    return $this->hasMany(ServiceAdvantage::class)->orderBy('order');
}

public function features()
{
    return $this->hasMany(ServiceFeature::class)->orderBy('order');
}
}