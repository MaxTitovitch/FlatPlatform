<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dialog extends Model
{
    protected $fillable = [
        'type', 'first_user_id', 'second_user_id',
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
}
