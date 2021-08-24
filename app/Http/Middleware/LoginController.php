<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Users;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * https://developers.facebook.com/apps/    VIETPRO-APP
     * https://www.youtube.com/watch?v=jYpRBn1t8L0
     * https://laravel.com/docs/7.x/socialite
     * Đối số 1 được chuyển đến Illuminate \ Auth \ EloquentUserProvider :: validateCredentials () phải là một phiên bản
     * https://stackoverflow.com/questions/50463155/laravel-5-5-type-error-argument-1-passed-to-illuminate-auth-eloquentuserprovide
     *
     */
    public function redirectToProvider()
    {
        dd(1);
        return Socialite::driver('facebook')->redirect();
    }
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();
        $check = Users::where('user_email', '=', $user->id)->first();
        if ($check) {
            Auth::login($check);
            return redirect()->route('admin.index');
        } else {
            $data = new Users();
            $data->user_fullname = $user->name;
            $data->user_email = $user->id;
            $data->password = bcrypt('123456');
            $data->user_address = '';
            $data->user_phone = '';
            $data->remember_token = '';
            $data->provider = '';
            $data->provider_id = '';
            $data->user_level = '0';
            $data->save();
            Auth::login($data);
            return redirect()->route('admin.index');
        }
    }
}
