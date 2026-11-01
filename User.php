<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'telegram_id',
        'public_id',
        'first_name',
        'last_name',
        'username',
        'language_code',
        'profile_image_id',
        'is_premium',
    ];

    protected function casts(): array
    {
        return [
            'telegram_id' => 'integer',
            'is_premium'  => 'boolean',
        ];
    }

    public function profileImage(): BelongsTo
    {
        return $this->belongsTo(File::class, 'profile_image_id');
    }

    public function folders(): HasMany
    {
        return $this->hasMany(Folder::class, 'owner_id');
    }

    // فولدر لایک (system_key = liked)
    public function likedFolder(): HasOne
    {
        return $this->hasOne(Folder::class, 'owner_id')
            ->where('system_key', 'liked');
    }

    public function friends(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')
            ->withTimestamps();
    }

    public function playHistory(): HasMany
    {
        return $this->hasMany(PlayHistory::class);
    }

    public function downloads(): HasMany
    {
        return $this->hasMany(Download::class);
    }
}
