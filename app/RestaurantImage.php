<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestaurantImage extends Model
{
    protected $fillable = [
        'image',
       ' restaurant_id',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}