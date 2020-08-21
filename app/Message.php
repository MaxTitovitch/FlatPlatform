<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'message', 'type', 'user_id', 'dialog_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function dialog()
    {
        return $this->belongsTo('App\Dialog');
    }
}
