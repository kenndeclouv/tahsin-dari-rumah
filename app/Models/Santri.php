<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'no_hp',
        'additional_data',
        'status',
    ];

    protected $casts = [
        'additional_data' => 'array',
    ];

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }
}
