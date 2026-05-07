<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessKey extends Model {
    
    protected $fillable = [
    'game_id',
    'game_version_id',
    'key',
    'status',
    'sold_at',
    'expires_at'
    ];

    public function Game(){
        return $this->belongsTo(Game::class);
    }

    public function GameVersion(){
        return $this->belongsTo(GameVersion::class);
    }
}
