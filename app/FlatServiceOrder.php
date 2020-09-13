<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlatServiceOrder extends Model
{
    protected $table = 'flat_orders';

    protected $fillable = [
        'price', 'landlord_confirmation', 'tenant_confirmation', 'date_start', 'date_end', 'status', 'tenant_id', 'flat_id'
    ];

    public function flat()
    {
        return $this->belongsTo('App\Flat');
    }

    public function tenant()
    {
        return $this->belongsTo('App\User', 'tenant_id', 'id');
    }

    public function landlord()
    {
        return $this->flat->user();
    }

    public function dialogs()
    {
        return $this->hasMany('App\Dialog', 'flat_order_id');
    }
}
