<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PassportEntered
{
    public function handle($request, Closure $next)
    {
        if(!Auth::user()->isEnteredPassportData()) {
            Session::flash('status-error', 'Заполните паспортные данные!');
            return redirect()->route('home');
        }
        return $next($request);
    }
}
