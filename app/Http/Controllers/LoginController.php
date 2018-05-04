<?php

namespace AvisoNavAPI\Http\Controllers;

use AvisoNavAPI\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }

        $user = User::find(1);

        // Creating a token without scopes...
        $token = $user->createToken('Token Name')->accessToken;

        return $token;
    }

    public function logout(Request $request)
    {
        $value = $request->bearerToken();
        $request->user()->token()->revoke();

        // dd($request->user());
    }

}
