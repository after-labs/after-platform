<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    
    protected $fillable = [
    'user_id',
    'total'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function items(){
        return $this->hasMany(OrderItem::class);
    }
    /* soon: payment logic with dedicated model
    public function paymentTransactions(){
        return $this->hasMany(PaymentTransaction::class);
    } */
}
