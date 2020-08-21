<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HouseholdServiceCategory extends Model
{
    protected $fillable = [
        'name',
    ];

    public function household_services()
    {
        return $this->hasMany('App\HouseholdService');
    }
}
