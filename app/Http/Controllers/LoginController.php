<?php

namespace AvisoNavAPI\Http\Controllers;

use AvisoNavAPI\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use AvisoNavAPI\Http\Requests\LoginType;
use Illuminate\Auth\AuthenticationException;

class LoginController extends Controller
{

    /**
     * Metodo para autenticar un usuario y obtener un token
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(LoginType $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        $scope = $user->role->permission->implode('name', ' ');

        if(strcmp($user->state, 'I') === 0)
        {
            throw new AuthenticationException();
        }

        return $this->getToken('password', ['username' => $request->input('email'), 'password' => $request->input('password'), 'scope' => $scope]);
    }
    
    public function logout(Request $request)
    {
        // $value = $request->bearerToken();
        
        $accessToken = $request->user()->token();
        
        $refreshToken = app()->make('db')
                            ->table('oauth_refresh_tokens')
                            ->where('access_token_id', $accessToken->id)
                            ->update([
                                'revoked' => true
                                ]);
                                
        $accessToken->revoke();

        Cookie::queue(Cookie::forget('refresh_token'));
                                
        return response(null, 204);
    }
    
    public function refresh(Request $request)
    {
        $refreshToken = $request->cookie('refresh_token');

        return $this->getToken('refresh_token', ['refresh_token' => $refreshToken]);
    }
    

    /**
     * Este metodo es sirve para obtener un token para un usuario autenticado
     * 
     * @param string $grantType Tipo de grant type que se utilizara para generar un token
     * @param array $data Datos necesarios para solicitar un token
     */
    protected function getToken($grantType, array $data = [])
    {
        $data = array_merge($data, [
            'client_id'     => env('PASSWORD_CLIENT_ID'),
            'client_secret' => env('PASSWORD_CLIENT_SECRET'),
            'grant_type'    => $grantType
            ]);
            
        $request = Request::create('/oauth/token', 'POST', $data);
        
        $response = app()->handle($request);
        
        if($response->getStatusCode() == 401)
        {
            throw new AuthenticationException();
        }

        $data = json_decode($response->getContent());

        /*
        Guardamos el token de actualización en una cookie HttpOnly. Este
        se adjuntará a la respuesta en forma de encabezado de Set-Cookie. 
        Ahora el cliente tendrá esta cookie y puede usarlo para 
        solicitar nuevos tokens de acceso cuando las viejos caducan.
        */
        Cookie::queue(Cookie::make(
            'refresh_token',
            $data->refresh_token,
            864000, // 10 days
            null,
            null,
            false,
            true // HttpOnly
        ));
        
        return [
            'access_token' => $data->access_token,
            'expires_in' => $data->expires_in
        ];
    }

}
