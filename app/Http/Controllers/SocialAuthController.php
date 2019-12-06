<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\SocialAuth;

class SocialAuthController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $user =  Socialite::driver($provider)->user();
//        dd($user);
        $account = SocialAuth::where([
            'provider' => $provider,
            'social_id' => $user->id,
        ])->first();
        if($account) {
            auth()->login($account->user);
//            dd('conta existe');
            return redirect()->to('/');
        }

        $localUser = User::where('email', $user->email)->first();
        if($localUser) {
//            dd('usuario existe');
            return redirect()->to('/');
        }
//        dd($provider);
        $newUser = new User();
        $newUser->name = $user->name;
        (!$user->email) ? $newUser->email = $user->id : $newUser->email = $user->email;
        $newUser->password = md5(rand(1, 1000));
        $newUser->save();

        $newAccount = new SocialAuth();
        $newAccount->provider = $provider;
        $newAccount->social_id = $user->id;
        $newAccount->user_id = $newUser->id;
        $newAccount->save();

        auth()->login($newUser);

        return redirect()->to('/');
    }
}
