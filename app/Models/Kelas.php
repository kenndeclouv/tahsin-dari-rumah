<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'santri_id',
        'pengajar_id',
        'paket_belajar_id',
        'hari_jam',
        'jumlah_pertemuan',
        'status',
        'payment_status',
    ];

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }

    public function pengajar()
    {
        return $this->belongsTo(Pengajar::class, 'pengajar_id');
    }

    public function paketBelajar()
    {
        return $this->belongsTo(PaketBelajar::class);
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
