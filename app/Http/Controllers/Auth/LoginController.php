<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Utils\Common\UserRoles;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/verification';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function authenticated(Request $request,User $user)
    {
        $user->update(['ip_address'=>$request->ip(),'last_login' => now()]);
        if($user->role == UserRoles::USER)
        {
            return redirect()->route('home');
        }
        return redirect()->route('home');

        // if($user->role == UserRoles::ADMIN)
        // {
        //     return redirect()->route('dashboard');
        // }
        // elseif($user->role == UserRoles::USER)
        // {
        //     return redirect()->route('dashboard');
        // }
        // elseif($user->role == UserRoles::VENDOR)
        // {
        //     return redirect()->route('dashboard');
        // }
    }
}
