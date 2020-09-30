<?php

namespace App;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class User extends \TCG\Voyager\Models\User implements MustVerifyEmail
{
    use Notifiable;

    protected $fillable = [
        'name', 'last_name', 'email', 'phone', 'reserve_phone',  'passport_number',  'date_of_issue',  'date_of_birth',  'role_id',  'avatar', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo('TCG\Voyager\Models\Role');
    }

    public function flats()
    {
        return $this->hasMany('App\Flat');
    }

    public function tenant_flat_orders()
    {
        return $this->hasMany('App\FlatServiceOrder', 'tenant_id');
    }

    public function dialogs()
    {
        return $this->hasMany('App\Dialog');
    }

    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    public function household_services()
    {
        return $this->hasMany('App\HouseholdService');
    }

    public function landlord_household_orders()
    {
        return $this->hasMany('App\HouseholdServiceOrder', 'landlord_id');
    }

    public function uploadAvatar($request) {
        $file = $request->file('avatar');
        $date = date('FY');
        $path = Storage::disk('public')->putFileAs("users/$date", $file,Str::random(20) . '.' . $file->extension());
        $this->avatar = str_replace('public', '', $path);
    }

    public function deleteAvatar() {
        $avatar = $this->avatar;
        if($avatar !== 'users/default.png') {
            Storage::disk('public')->delete($avatar);
        }
    }

    public function updateAvatar($request) {
        if($request->hasFile('avatar')) {
            $this->deleteAvatar();
            $this->uploadAvatar($request);
        }
    }

    public function isEnteredPassportData() {
        return $this->passport_number && $this->date_of_issue && $this->date_of_birth;
    }

    public function canMakeOrder ($flatId) {
        $orders = Flat::find($flatId)->orders;
        foreach ($orders as $order){
            if($this->id === $order->tenant_id && $order->status !== 'Выполнен'){
                return false;
            }
        }
        return true;
    }

    public function getUnreadDialogsQuantity() {
        $count = 0;
        $dialog = Dialog::where("dialogs.first_user_id", $this->id)->orWhere("dialogs.second_user_id", $this->id)->get();
        foreach ($dialog as $dialog) {
            foreach ($dialog->messages as $message) {
                if($message->read_status !== 'Прочитано' && $message->user_id != Auth::id()) {
                    $count++;
                }
            }
        }
        return $count;
    }

    public function getUnreadServicesQuantity() {
        $count = 0;
        if(Auth::user()->role->name == 'employee') {
            foreach ($this->household_services as $household_service) {
                foreach ($household_service->orders as $order) {
                    if ($order->read_status !== 'Прочитано') {
                        $count++;
                    }
                }
            }
        }
        return $count;
    }

    public function getUnreadFlatsQuantity() {
        $count = 0;
        if(Auth::user()->role->name == 'landlord') {
            foreach ($this->flats as $flat) {
                foreach ($flat->orders as $order) {
                    if ($order->read_status !== 'Прочитано') {
                        $count++;
                    }
                }
            }
        }
        return $count;
    }

    public function sendPasswordResetNotification($token) {
        $this->notify(new ResetPasswordNotification($token));
    }
}
