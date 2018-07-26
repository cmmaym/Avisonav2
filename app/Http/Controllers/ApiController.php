<?php

namespace AvisoNavAPI\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('client')->only(['index', 'show']);
        $this->middleware('auth:api');
        $this->middleware('scope:read')->only(['index', 'show']);
        $this->middleware('scope:create')->only(['store']);
        $this->middleware('scope:delete')->only(['delete']);
        $this->middleware('scope:update')->only(['update']);
    }

    protected function withLanguageQuery()
    {
        $language = request()->input('language');
        
        return function($query) use ($language){
            if($language)
            {
                return $query->whereHas('language', function($query) use ($language){
                    $query->where('code', '=', $language);
                });
            }else{
                return null;
            }
        };
    }

}
