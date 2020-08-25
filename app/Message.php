<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\MessageRequest;
use Illuminate\Support\Facades\Storage;

class Message extends Model
{
    protected $fillable = [
        'message', 'type', 'user_id', 'dialog_id',
    ];

    public function upload(MessageRequest $request) {
        $file = $request->file('file');
        $path = Storage::disk('public')->putFile('message-file', $file);
        $path = env('APP_URL') . '/storage/' . $path;
        return $path;
    }


    public function deleteFile() {
        Storage::delete($this->message);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function dialog()
    {
        return $this->belongsTo('App\Dialog');
    }
}
