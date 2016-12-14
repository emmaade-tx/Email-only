<?php

namespace App\Http;

use Auth;
use App\LoginToken;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use League\Flysystem\Exception;

class AuthenticateUser
{
    use validatesRequests;

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function invite()
    {
        $this->validateRequest()
            ->createToken()
            ->send();

    }

    private function validateRequest()
    {
        $this->validate($this->request, [
           'email' => 'required|email|exists:users'
        ]);

        return $this;
    }

    private function createToken()
    {
        $user = User::byEmail($this->request->email);

        return LoginToken::generateFor($user);
    }

    /**
     * @param LoginToken $token
     */
    public function login(LoginToken $token)
    {
        $user = Auth::login($token->user);
        $token->delete();
    }
}