<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleProviderCallback()
    {
        // $user = Socialite::driver('facebook')->user();
        $user = Socialite::driver('facebook')->stateless()->user();
        $check = Users::where('fb_id', '=', $user->id)->first();
        if ($check) {
            Auth::guard('guest')->login($check);
            return redirect()->route('index');
        } else {
            $data = new Users();
            $data->name = $user->name;
            $data->slug = Str::slug($user->name);
            if ($user->email != null) {
                $data->email = $user->email;
            } else {
                $data->email = Str::random(10);
            }
            $data->image = $user->avatar;
            $data->fb_id = $user->id;
            $data->password = bcrypt('123456');
            $data->address = '0';
            $data->phone = '0';
            $data->remember_token = '';
            $data->save();
            Auth::guard('guest')->login($data);
            return redirect()->route('index');
        }
    }
    public function redirect_social()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callback_social()
    {
        try {
            // $user = Socialite::driver('google')->user();
            $user = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            return redirect()->route('site_signup');
        }
        //$check = Users::where('fb_id', '=', $user->id)->first();
        $existingUser = Users::where('email', $user->getEmail())->first();
        if ($existingUser) {
            Auth::guard('guest')->login($existingUser);
            return redirect()->route('index');
        } else {
            $data = new Users();
            $data->name = $user->name;
            $data->slug = Str::slug($user->name);
            if ($user->email != null) {
                $data->email = $user->email;
            } else {
                $data->email = Str::random(10);
            }
            $data->image = 'no-img.jpg';
            $data->provider_id = $user->id;
            $data->password = bcrypt('123456');
            $data->address = '0';
            $data->phone = '0';
            $data->remember_token = '';
            $data->save();
            Auth::guard('guest')->login($data);
            return redirect()->route('index');
        }
    }
}
