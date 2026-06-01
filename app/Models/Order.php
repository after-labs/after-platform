<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    
    protected $fillable = [
    'user_id',
    'status',
    'subtotal',
    'coupon_code',
    'coupon_discount',
    'coins_used',
    'coin_discount',
    'stripe_checkout_session_id',
    'stripe_payment_intent_id',
    'paid_at',
    'fulfilled_at',
    'total'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function items(){
        return $this->hasMany(OrderItem::class);
    }

    public function accessKeys(){
        return $this->hasMany(AccessKey::class);
    }
}
