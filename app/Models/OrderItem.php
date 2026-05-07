<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model {
    
    protected $fillable = [
    'game_version_id',
    'units',
    'order_id',
    'price'
    ];

    public function Order(){
        return $this->belongsTo(Order::class);
    }

    public function GameVersion(){
        return $this->belongsTo(GameVersion::class);
    }
}
