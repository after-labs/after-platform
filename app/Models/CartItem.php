<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
    'user_id',
    'game_version_id',
    'units'
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function GameVersion(){
        return $this->belongsTo(GameVersion::class);
    }
}
