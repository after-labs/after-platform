<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishlistItem extends Model {
    protected $fillable = [
    'user_id',
    'game_id'
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Game(){
        return $this->belongsTo(Game::class);
    }
}
