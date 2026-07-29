<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajar extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'additional_data',
        'status',
    ];

    protected $casts = [
        'additional_data' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paketBelajars()
    {
        return $this->hasMany(PaketBelajar::class, 'pengajar_id');
    }
}
