<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'name',
        'description',
        'summary',
        'age',
        'release_date',
        'developer',
        'category_id',
        'featured',
        'system_requirements',
    ];

    public function versions()
    {
        return $this->hasMany(GameVersion::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'game_genres');
    }

    public function accessKeys()
    {
        return $this->hasMany(AccessKey::class);
    }

    public function wishlistItems()
    {
        return $this->hasMany(WishlistItem::class);
    }

    public function media()
    {
        return $this->hasMany(GameMedia::class);
    }

    public function poster()
    {
        return $this->media->where('type', 'poster')->first();
    }

    public function banner()
    {
        return $this->media->where('type', 'banner')->first();
    }

    public function gameplays()
    {
        return $this->media->where('type', 'gameplay');
    }

    public function video()
    {
        return $this->media->where('type', 'video')->first();
    }
}
