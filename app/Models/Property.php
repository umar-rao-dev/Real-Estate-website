<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'description',
        'price',
        'beds',
        'baths',
        'area',
        'location',
        'type',
        'availability',
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function category() { return $this->belongsTo(Category::class); }
    public function images() { return $this->hasMany(PropertyImage::class); }
    public function queries() { return $this->hasMany(Query::class); }
    public function orders() { return $this->hasMany(Order::class); }
}
