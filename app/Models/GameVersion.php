<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameVersion extends Model
{
    protected $fillable = [
    'offer_id',
    'game_id',
    'edition_name',
    'platform_id',
    'base_price',
    'final_price',
    'stock',
    'active'
    ];

    public function game(){
        return $this->belongsTo(Game::class);
    }

    public function platform(){
        return $this->belongsTo(Platform::class);
    }

    public function offer(){
        return $this->belongsTo(Offer::class);
    }

    public function cartItems(){
        return $this->hasMany(CartItem::class);
    }

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }

    public function accessKeys(){
        return $this->hasMany(AccessKey::class);
    }
}
