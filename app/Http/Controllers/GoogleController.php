<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    //
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('google')->user();

        // Check Users Email If Already There
        $is_user = User::where('google_id', $user->id)->first();
        if (!$is_user) {

            $saveUser = User::updateOrCreate([
                'google_id' => $user->id,
            ], [
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password,
                'google_token' => $user->token,
                'google_refresh_token' => $user->refreshToken,
            ]);
            Auth::login($saveUser);
            return redirect('/home');
        }


        Auth::login($is_user);

        return redirect('/home');
    }
}
