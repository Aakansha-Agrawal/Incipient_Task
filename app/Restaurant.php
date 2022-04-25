<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Restaurant extends Model
{
    use SoftDeletes, Notifiable;

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'phone',
        'created_at',
        'updated_at',
        'deleted_at',
        'code',
        'desc'
    ];

    public function restaurant_image()
    {
        return $this->hasOne(RestaurantImage::class);
    }
}
