<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\SocialAccount;
use App\Http\Requests\UserSocialRequest;

class SocialiteController extends Controller
{
    public function index ($provider) {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider) {
        $isNeedEmail = false;
        $socialiteUser = Socialite::driver($provider)->user();
        $user = $this->findOrCreateUser($provider, $socialiteUser, $isNeedEmail);
        if($user) {
            Auth::login($user, true);
            return redirect()->route('index');
        } else {
            return view('auth.supplement', ['isNeedEmail' => true, 'provider' => $provider]);
        }
    }

    public function save(UserSocialRequest $request, $provider) {
        $socialiteUser = Socialite::driver($provider)->user();
        $user = User::create([
            'name' => $socialiteUser->getName(),
            'last_name' => $socialiteUser->getNickname(),
            'email' => $socialiteUser->getEmail() ?? $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
            'role_id' => $request->role_id,
        ]);

        $this->addSocialAccount($provider, $user, $socialiteUser);
        Auth::login($user, true);
        return redirect()->route('index');
    }

    private function findOrCreateUser($provider, $socialiteUser, &$isNeedEmail) {
        if ($user = SocialAccount::where('provider', $provider)->where('provider_id', $socialiteUser->getId())->first()->user) {
            return $user;
        }
        if ($user = User::where('email', $socialiteUser->getEmail())->first() && $socialiteUser->getEmail() !== null) {
            $this->addSocialAccount($provider, $user, $socialiteUser);
            return $user;
        } else {
            $isNeedEmail = true;
            return false;
        }
    }

    public function addSocialAccount($provider, $user, $socialiteUser) {
        SocialAccount::create([
            'user_id' => $user->id,
            'provider' => $provider,
            'provider_id' => $socialiteUser->getId(),
            'token' => $socialiteUser->token,
        ]);
    }
}
