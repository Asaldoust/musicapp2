<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'file_name',
        'file_type',
        'mime_type',
        'file_size',
        'telegram_file_id',
        'file_url',
    ];

    protected function casts(): array
    {
        return [
            'file_size' => 'integer',
        ];
    }
}
