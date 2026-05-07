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

    public function Game(){
        return $this->belongsTo(Game::class);
    }

    public function Platform(){
        return $this->belongsTo(Platform::class);
    }

    public function Offer(){
        return $this->belongsTo(Offer::class);
    }

    public function CartItems(){
        return $this->hasMany(CartItem::class);
    }

    public function OrderItems(){
        return $this->hasMany(OrderItem::class);
    }

    public function AccessKeys(){
        return $this->hasMany(AccessKey::class);
    }
}
