<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Requests\UserRequest;

class HomeController extends Controller
{
    public function index() {
        return view('personal.home', ['user' => Auth::user()]);
    }

    public function updateUser(UserRequest $request) {
        $user = Auth::user();
        if($user->email !== $request->email) {
            $user->email_verified_at = null;
        }
        $user->update($request->all());
        $user->updateAvatar($request);
        $user->save();
        $request->session()->flash('status-success', 'Данные успешно обновлены!');
        return redirect()->route('home');
    }
}
