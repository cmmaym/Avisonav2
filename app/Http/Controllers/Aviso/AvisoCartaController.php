<?php

namespace AvisoNavAPI\Http\Controllers\Aviso;

use AvisoNavAPI\Aviso;
use AvisoNavAPI\Carta;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Responser;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\Carta as CartaResource;
use AvisoNavAPI\Http\Resources\CartaCollection;

class AvisoCartaController extends Controller
{

    use Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Aviso $aviso)
    {
        $query = $aviso->carta();

        $collection = $this->showAll($query, CartaResource::class, CartaCollection::class);
        
        return $collection;
    }

}
