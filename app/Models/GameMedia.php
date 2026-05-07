<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameMedia extends Model
{
    protected $fillable = [
    'game_id',
    'type',
    'path'
    ];

    public function Game(){
        return $this->belongsTo(Game::class);
    }
}
