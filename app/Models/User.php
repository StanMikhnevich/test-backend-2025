<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    const IMAGE_PATH = 'images/users';

    protected $fillable = [
        'position_id',
        'name',
        'email',
        'phone',
        'photo',
    ];

    protected $hidden = [
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function getPhoneDisplayAttribute(): string
    {
        return formatPhone($this->phone);
    }

    public function getPhotoPathAttribute(): string
    {
        return self::IMAGE_PATH . '/' . $this->photo;
    }
}
