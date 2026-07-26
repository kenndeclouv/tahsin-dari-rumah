<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketBelajar extends Model
{
    use HasFactory;

    protected $fillable = [
        'santri_id',
        'pengajar_id',
        'fee_id',
        'hari_jam',
        'jumlah_pertemuan',
        'status',
        'payment_status',
        'additional_data',
    ];

    protected $casts = [
        'additional_data' => 'array',
    ];

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }

    public function pengajar()
    {
        return $this->belongsTo(User::class, 'pengajar_id');
    }

    public function fee()
    {
        return $this->belongsTo(Fee::class);
    }

    public function presensis()
    {
        return $this->hasMany(Presensi::class);
    }

    public function evaluasi()
    {
        return $this->hasOne(Evaluasi::class);
    }
}
