<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'game_version_id',
        'units',
        'order_id',
        'price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function gameVersion()
    {
        return $this->belongsTo(GameVersion::class);
    }
}
