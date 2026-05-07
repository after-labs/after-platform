<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    
    protected $fillable = [
    'user_id',
    'total'
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Items(){
        return $this->hasMany(OrderItem::class);
    }

    public function PaymentTransactions(){
        return $this->hasMany(PaymentTransaction::class);
    }
}
