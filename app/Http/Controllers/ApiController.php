<?php

namespace AvisoNavAPI\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function __construct()
    {
        if(!request()->exists('language')) request()->merge(['language' => '1']);

        $this->middleware('client')->only(['index', 'show']);
        $this->middleware('auth:api');
        $this->middleware('scope:read')->only(['index', 'show']);
        $this->middleware('scope:create')->only(['store']);
        $this->middleware('scope:delete')->only(['delete']);
        $this->middleware('scope:update')->only(['update']);
    }

}
