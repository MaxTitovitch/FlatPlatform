<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\HomeUserRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index() {
        return view('personal.home', ['user' => Auth::user()]);
    }

    public function updateUser(HomeUserRequest $request) {
        $user = Auth::user();
        $except = ['password_confirmation', 'avatar', 'password'];
        if (Hash::check($request->last_password, $user->password)) {
            if ($user->email !== $request->email) {
                $user->email_verified_at = null;
            }
            $user->update($request->except($except));
            if($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->updateAvatar($request);
            $user->save();
            Session::flash('status-success', 'Данные успешно обновлены!');
            return redirect()->route('home');
        } else {
            Session::flash('status-error', 'Неверный текущий пароль');
            return redirect()->route('home');
        }
    }
}
