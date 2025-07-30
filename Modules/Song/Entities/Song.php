<?php

namespace Modules\Song\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Album\Entities\Album;
use Modules\Category\Entities\Category;

class Song extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'artist',
        'album_id',
        'cover_art',
        'file_path',
        'play_count',
        'type',
        'duration',
        'release_date',
        'category_id',
    ];


    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    protected static function newFactory()
    {
        return \Modules\Song\Database\factories\SongFactory::new();
    }
}
