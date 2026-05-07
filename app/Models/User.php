<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
    'name',
    'email',
    'email_verified_at',
    'password',
    'phone',
    'country',
    'role',
    'status',
    'avatar',
    'last_login_at'
];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // td: why Quintas didn't gave the User model the hasMany methods to make the connections with other models?

    public function CartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function Orders()
    {
        return $this->hasMany(Order::class);
    }

    public function Gamification()
    {
        return $this->hasOne(Gamification::class);
    }

    public function Notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function Wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }
}
