<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
    protected $fillable = [
        'street', 'house_number', 'description', 'floor', 'area', 'living_area', 'number_of_rooms', 'city', 'type_of_premises', 'rental_period', 'price', 'photos', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function orders()
    {
        return $this->hasMany('App\FlatServiceOrder');
    }
}
