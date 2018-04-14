<?php

namespace AvisoNavAPI\Http\Controllers\Language;

use AvisoNavAPI\Aviso;
use AvisoNavAPI\Language;
use Illuminate\Http\Request;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\AyudaResource;

class LanguageAvisoAyudaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Idioma $idioma, Aviso $aviso)
    {

        $query = $aviso->ayudas();

        $coordenadaConstraint = function($query){
            if($latitud = request()->get('latitud')) $query->where('latitud', $latitud);
            if($altitud = request()->get('altitud')) $query->where('altitud', $altitud);
            if($alcance = request()->get('alcance')) $query->where('alcance', $alcance);
            if($cantidad = request()->get('cantidad')) $query->where('cantidad', $cantidad);
        };

        $coordenadaDetalleConstraint = function($query) use ($idioma){
            $query->where('idioma_id', $idioma->id);
        };

        if($numero = request()->get('numero')) $query->where('numero', $numero);
        if($nombre = request()->get('nombre')) $query->where('nombre', 'like', "%$nombre%");

        $query->with([
                    'coordenada' => $coordenadaConstraint,
                    'coordenada.coordenadaDetalle' => $coordenadaDetalleConstraint
                ])
              ->whereHas('coordenada', $coordenadaConstraint)
              ->whereHas('coordenada.coordenadaDetalle', $coordenadaDetalleConstraint);
             
        $collection = $query->paginate(1)->appends(request()->all());
        
        return AyudaResource::collection($collection);

    }

}
