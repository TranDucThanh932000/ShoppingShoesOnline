<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class SocialController extends Controller
{
    public function redirectGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function processGoogleLogin(){
        $googleUser = Socialite::driver('google')->user();
        if(!$googleUser){
            return redirect()->route('login');
        }

        $systemUser = User::where('google_id', $googleUser->id)->first();
        if(!$systemUser){
            $systemUser = User::create([
                'name' => $googleUser->name,
                'email' => 'google_'. $googleUser->email,
                'google_id' => $googleUser->id,
                'manage' => 0,
                'avatar' => 'https://icon-library.com/images/user-icon/user-icon-14.jpg'
            ]);
        }
        auth()->loginUsingId($systemUser->id);
        session()->put('user',$systemUser->email);
        return redirect()->route('home.homepage');
    }
}