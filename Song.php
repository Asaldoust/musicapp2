<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Song extends Model
{
    protected $fillable = [
        'title',
        'duration',
        'album_id',
        'audio_file_id',
        'cover_image_id',
        'play_count',
    ];

    protected function casts(): array
    {
        return [
            'duration'   => 'integer',
            'play_count' => 'integer',
        ];
    }

    // سینگل = album null
    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }

    public function audioFile(): BelongsTo
    {
        return $this->belongsTo(File::class, 'audio_file_id');
    }

    public function coverImage(): BelongsTo
    {
        return $this->belongsTo(File::class, 'cover_image_id');
    }

    public function artists(): BelongsToMany
    {
        return $this->belongsToMany(Artist::class, 'song_artists')
            ->withPivot('display_order')
            ->orderByPivot('display_order');
    }

    public function folders(): BelongsToMany
    {
        return $this->belongsToMany(Folder::class, 'folder_songs')
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

    public function trend(): HasOne
    {
        return $this->hasOne(TrendSong::class);
    }
}
