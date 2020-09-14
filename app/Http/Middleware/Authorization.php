<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Authorization
{
    public function handle(Request $request, Closure $next, $role, $secondRole = null) {
        $userRole = Auth::user()->role->name;
        if($userRole != $role && $userRole != $secondRole) {
            $request->session()->flash('status-error', 'Не доступно для вашей роли');
            return redirect()->route('home');
        }
        return $next($request);
    }
}
