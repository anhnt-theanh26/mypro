<?php

namespace Modules\Album\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Category\Entities\Category;

class Album extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'artist',
        'thumbnail',
        'release_date',
    ];

    protected static function newFactory()
    {
        return \Modules\Album\Database\factories\AlbumFactory::new();
    }
}
