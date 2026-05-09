<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gamification extends Model {
    protected $fillable = [
    'user_id',
    'level',
    'points',
    'coins'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
