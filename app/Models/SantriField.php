<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SantriField extends Model
{
    protected $fillable = [
        'label',
        'name',
        'type',
        'options',
        'is_required',
        'order',
    ];

    protected $casts = [
        'options' => 'array',
        'is_required' => 'boolean',
    ];
}
