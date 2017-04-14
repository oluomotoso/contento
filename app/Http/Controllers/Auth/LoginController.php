<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $redirectTo = '/user/dashboard';

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    protected function redirectTo()
    {
        $user = Auth::user();
        // Logic that determines where to send the user
        if ($user->user_role_id == 5) {
            return ('/admin');

        } elseif ($user->user_role_id == 2) {
            return ('/reseller');
        }

        return ('/user');
    }


    public function redirectToFacebook()
    {
        $provider = 'facebook';
        return Socialite::driver($provider)->redirect();
    }

    public function redirectToGoogle()
    {
        $provider = 'google';
        return Socialite::driver($provider)->redirect();
    }

    public function redirectToTwitter()
    {
        $provider = 'twitter';
        return Socialite::driver($provider)->redirect();
    }


    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect($this->redirectTo());
    }

    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->where('provider', $provider)->first();
        if ($authUser) {
            return $authUser;
        }

        $user = User::updateOrCreate(['email' => $user->email], [
            'name' => $user->name,
            'provider' => $provider,
            'provider_id' => $user->id
        ]);
        $user->notify(new SignUpNotification($user));
        return $user;

    }
}
