<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
        'role',
        'theme',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdmin() { return $this->role === 'admin'; }
    public function isAgent() { return $this->role === 'agent'; }
    public function isUser() { return $this->role === 'user'; }

    public function properties() { return $this->hasMany(Property::class); }
    public function orders() { return $this->hasMany(Order::class, 'buyer_id'); }
    public function agentOrders() { return $this->hasMany(Order::class, 'agent_id'); }
}
