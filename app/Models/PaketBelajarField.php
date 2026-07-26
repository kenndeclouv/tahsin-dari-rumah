<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketBelajarField extends Model
{
    protected $fillable = [
        'name',
        'label',
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
