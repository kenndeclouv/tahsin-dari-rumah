<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'paket_belajar_id',
        'tanggal',
        'kehadiran',
        'foto',
        'catatan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function paketBelajar()
    {
        return $this->belongsTo(PaketBelajar::class);
    }
}
