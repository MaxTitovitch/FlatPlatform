<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dialog extends Model
{
    protected $fillable = [
        'type', 'first_user_id', 'second_user_id', 'flat_id', 'household_service_id'
    ];

    public function first_user()
    {
        return $this->belongsTo('App\User', 'first_user_id');
    }

    public function second_user()
    {
        return $this->belongsTo('App\User', 'second_user_id');
    }

    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    public function flat_order()
    {
        return $this->belongsTo('App\FlatServiceOrder', 'flat_order_id', 'id');
    }

    public function household_service_order()
    {
        return $this->belongsTo('App\HouseholdServiceOrder');
    }
}
