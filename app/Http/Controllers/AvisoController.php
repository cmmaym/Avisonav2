<?php

namespace AvisoNavAPI\Http\Controllers;

use AvisoNavAPI\Aviso;
use Illuminate\Http\Request;

class AvisoController extends Controller
{
    public function index(){

        $aviso = Aviso::all();

        return $aviso;
    }
}
