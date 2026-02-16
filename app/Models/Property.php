<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'price',
        'beds',
        'baths',
        'area',
        'location',
        'type',
        'availability',
        'status',
        'is_approved',
        'main_image'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'area' => 'decimal:2',
        'is_approved' => 'boolean',
    ];

    // Property belongs to user (agent)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Alias for user relationship
    public function agent()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Property belongs to category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Property has many images
    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    // Property has many queries
    public function queries()
    {
        return $this->hasMany(Query::class);
    }
}
