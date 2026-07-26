<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
        'jenis_kelamin',
        'alamat',
        'no_hp',
        'pendidikan_terakhir',
        'status',
        'admin_notes',
        'additional_data',
    ];

    /**
     * Get full URL for the user's profile photo.
     * Falls back to a generated initials avatar if no photo is set.
     */
    public function getPhotoUrlAttribute(): string
    {
        if ($this->photo) {
            return asset('storage/' . $this->photo);
        }
        // Return a placeholder generated from initials
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=4a9d5f&color=fff&size=80&bold=true';
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'additional_data' => 'array',
        ];
    }

    public function paketBelajars()
    {
        return $this->hasMany(PaketBelajar::class, 'pengajar_id');
    }

    /**
     * Send the password reset notification using our custom branded email.
     */
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
