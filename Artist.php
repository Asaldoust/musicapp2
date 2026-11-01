<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Artist extends Model
{
    protected $fillable = [
        'name',
        'image_id',
    ];

    public function image(): BelongsTo
    {
        return $this->belongsTo(File::class, 'image_id');
    }

    public function songs(): BelongsToMany
    {
        return $this->belongsToMany(Song::class, 'song_artists')
            ->withPivot('display_order');
    }

    public function albums(): BelongsToMany
    {
        return $this->belongsToMany(Album::class, 'album_artists')
            ->withPivot('display_order');
    }

    public function popular(): HasOne
    {
        return $this->hasOne(PopularArtist::class);
    }
}
