<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    protected $fillable = [
        'form_name',
        'data',
        'ip_address',
        'user_agent',
        'status',
    ];

    protected $casts = [
        'data' => 'array',
    ];
}
