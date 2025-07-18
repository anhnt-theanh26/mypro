<?php

namespace Modules\Song\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Song extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'artist',
        'album_id',
        'file_path',
        'play_count',
        'type',
        'duration',
        'release_date',
        'category_id',
    ];


    protected static function newFactory()
    {
        return \Modules\Song\Database\factories\SongFactory::new();
    }
}
