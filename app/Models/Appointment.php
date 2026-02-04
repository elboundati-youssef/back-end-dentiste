<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'preferred_date',
        'service',
        'message',
        'terms_accepted'
    ];
}