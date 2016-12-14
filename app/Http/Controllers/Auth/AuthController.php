<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\LoginToken;
use Illuminate\Http\Request;
use App\Http\AuthenticateUser;
use App\User;
use App\Http\Controllers\Controller;
use League\Flysystem\Exception;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    protected $auth;

    public function __construct(AuthenticateUser $auth)
    {
        $this->auth = $auth;
    }

    public function login()
    {
        return view('auth.login');
    }

    /**
     * @param AuthenticateUser $auth
     * @return string
     */
    public function postLogin(AuthenticateUser $auth)
    {
        $this->auth->invite();

        return "Link have been sent into your email";
    }

    /**
     * @param LoginToken $token
     * @return string
     */
    public function authenticate(LoginToken $token)
    {
        dd($token);
        $this->auth->login($token);

        return redirect('/home');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/home');
    }
}
