<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrendSong extends Model
{
    protected $fillable = [
        'song_id',
        'trend_score',
    ];

    protected function casts(): array
    {
        return [
            'trend_score' => 'decimal:2',
        ];
    }

    public function song(): BelongsTo
    {
        return $this->belongsTo(Song::class);
    }
}
