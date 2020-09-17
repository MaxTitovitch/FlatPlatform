<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Dialog extends Model
{
    protected $fillable = [
        'type', 'first_user_id', 'second_user_id', 'flat_order_id', 'household_service_order_id'
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

    public function readMessages() {
        $id = 0;
        foreach ($this->messages as $message) {
            if($message->user_id !== Auth::id() && $message->read_status != 'Прочитано') {
                $message->read_status = 'Прочитано';
                $message->save();
                $id++;
            }
        }
        return $id;
    }

    public function getUnreadMessagesQuantity() {
        $count = 0;
        foreach ($this->messages as $message) {
            if ($message->read_status !== 'Прочитано' && $message->user_id != Auth::id()) {
                $count++;
            }
        }
        return $count;
    }
}
