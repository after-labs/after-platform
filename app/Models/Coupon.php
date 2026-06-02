<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'discount_percent',
        'active',
        'starts_at',
        'expires_at',
        'max_uses',
        'times_used'
    ];

    public function isAvailable(): bool
    {
        if (! $this->active) {
            return false;
        }

        if ($this->starts_at && strtotime($this->starts_at) > time()) {
            return false;
        }

        if ($this->expires_at && strtotime($this->expires_at) < time()) {
            return false;
        }

        if ($this->max_uses && $this->times_used >= $this->max_uses) {
            return false;
        }

        return true;
    }
}
