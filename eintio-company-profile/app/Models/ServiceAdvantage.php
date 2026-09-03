<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceAdvantage extends Model
{
    protected $fillable = ['service_id', 'title', 'order'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}