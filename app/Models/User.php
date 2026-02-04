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
        'photo',
        'role',
        'theme',
    ];

    protected $hidden = [
        'password',
    ];

    /* =====================
        RELATIONSHIPS
    ====================== */

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function agentRequest()
    {
        return $this->hasOne(AgentRequest::class);
    }

    public function queries()
    {
        return $this->hasMany(Query::class);
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }
}
