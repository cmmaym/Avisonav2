<?php

namespace AvisoNavAPI\Http\Controllers;

use AvisoNavAPI\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;

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
            $user = User::where('email', $request->input('email'))->first();
            $scope = $user->role->permission->implode('name', ' ');

            $request = Request::create('/oauth/token', 'POST', [
                    'grant_type'    => 'password',
                    'client_id'     => '1',
                    'client_secret' => '3JQPQh0XQNM7bbN0U0bqPsnR28bocdpOAeXXoamB',
                    'username'      => $request->input('email'),
                    'password'      => $request->input('password'),
                    'scope'         => $scope,
            ] );

            $response = app()->handle($request);
            
            if($response->getStatusCode() == 401)
            {
                throw new AuthenticationException();
            }

            return response()->json($response->getContent(), $response->getStatusCode());
    }

    public function logout(Request $request)
    {
        $value = $request->bearerToken();
        $request->user()->token()->revoke();

        // dd($request->user());
    }

}
