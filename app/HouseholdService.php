<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HouseholdService extends Model
{
    protected $fillable = [
        'title', 'city', 'description', 'price', 'user_id', 'household_service_category_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\HouseholdServiceCategory', 'household_service_category_id');
    }

    public function orders()
    {
        return $this->hasMany('App\HouseholdServiceOrder');
    }
}
