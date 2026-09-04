<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebinarParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'webinar_id', 'name', 'email', 'whatsapp',
        'institution', 'occupation', 'notes', 'status',
    ];
}