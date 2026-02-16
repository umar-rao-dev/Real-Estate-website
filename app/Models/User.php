<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'role', 
        'phone',
        'profile_image', 
        'theme',
        'is_active'
    ];

    protected $hidden = [
        'password', 
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    // User has many properties (as agent)
    public function properties()
    {
        return $this->hasMany(Property::class, 'user_id');
    }

    // User has many agent requests
    public function agentRequests()
    {
        return $this->hasMany(AgentRequest::class, 'user_id');
    }

    // User has many queries (as user)
    public function queries()
    {
        return $this->hasMany(Query::class, 'user_id');
    }

    // Agent receives queries
    public function receivedQueries()
    {
        return $this->hasMany(Query::class, 'agent_id');
    }

    // User has many feedback
    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'user_id');
    }

    // Role helper methods
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isAgent()
    {
        return $this->role === 'agent';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }
}
