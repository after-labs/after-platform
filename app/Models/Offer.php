<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
    'name',
    'discount',
    'starts',
    'expiration'
    ];

    public function gameVersions(){
        return $this->hasMany(GameVersion::class);
    }
}
