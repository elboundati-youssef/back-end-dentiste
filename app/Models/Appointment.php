<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'preferred_date',
        'service',
        'message',
        'terms_accepted',
        'status'
    ];

    protected $casts = [
        'preferred_date' => 'date',
        'terms_accepted' => 'boolean',
    ];
}