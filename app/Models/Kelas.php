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

    // --- Scopes ---

    public function scopeBerjalan($query)
    {
        return $query->where('status', 'berjalan');
    }

    public function scopeMenungguEvaluasi($query)
    {
        return $query->where('status', 'menunggu_evaluasi');
    }

    public function scopeSelesai($query)
    {
        return $query->where('status', 'selesai');
    }

    public function scopeFilterByMonthYear($query, $dateColumn, $bulan, $tahun)
    {
        if ($bulan !== 'all') {
            $query->whereMonth($dateColumn, $bulan);
        }
        if ($tahun !== 'all') {
            $query->whereYear($dateColumn, $tahun);
        }
        return $query;
    }

    // --- Methods ---

    public function isFull(): bool
    {
        return $this->presensis()->count() >= $this->jumlah_pertemuan;
    }

    public function canBeManagedBy(User $user): bool
    {
        if ($user->isAdminOrSuperAdmin()) {
            return true;
        }

        return $user->pengajar?->id === $this->pengajar_id;
    }
}
