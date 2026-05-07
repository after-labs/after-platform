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
        'system_requirements'
    ];

    public function Media(){
        return $this->hasMany(GameMedia::class);
    }

    public function Versions(){
        return $this->hasMany(GameVersion::class);
    }

    public function Category(){
        return $this->belongsTo(Category::class);
    }

    public function Genres(){
        return $this->belongsToMany(Genre::class, 'game_genres');
    }

    public function AccessKeys(){
        return $this->hasMany(AccessKey::class);
    }

    public function Wishlists(){
        return $this->hasMany(Wishlist::class);
    }
}
