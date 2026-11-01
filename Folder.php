<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Folder extends Model
{
    protected $fillable = [
        'owner_id',
        'name',
        'icon',
        'color',
        'is_private',
        'system_key',
    ];

    protected function casts(): array
    {
        return [
            'is_private' => 'boolean',
        ];
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function songs(): BelongsToMany
    {
        return $this->belongsToMany(Song::class, 'folder_songs')
            ->withTimestamps();
    }
}
