<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        if(Auth::check())
        {
            dd(123);
            //$user->api_token = $user->createToken('api-application')->accessToken;
        }
    }

//    public function login(Request $request)
//    {
//        //dd($request->get("email"), $request->get("password"));
//        if (Auth::attempt(([
//            "email" => $request->get("email"),
//            "password" => $request->get("password")
//        ]))) {
//            /** @var User $user */
//            $user = Auth::user();
//            $user->api_token = $user->createToken('api-application')->accessToken;
//            return ["ok"];
//        }
//        return ["error"];
//    }
}
