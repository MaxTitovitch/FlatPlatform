<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HouseholdServiceOrder extends Model
{
    protected $fillable = [
        'price', 'status', 'employee_confirmation', 'landlord_confirmation', 'date_of_completion', 'landlord_id', 'household_service_id'
    ];

    public function household_service()
    {
        return $this->belongsTo('App\HouseholdService');
    }

    public function landlord()
    {
        return $this->belongsTo('App\User', 'landlord_id', 'id');
    }

    public function employee()
    {
        return $this->hasOneThrough('App\User', 'App\HouseholdService');
    }

    public function dialogs()
    {
        return $this->hasMany('App\Dialog');
    }
}
