<?php

namespace AvisoNavAPI\Http\Controllers\Ayuda;

use AvisoNavAPI\Ayuda;
use AvisoNavAPI\Version;
use AvisoNavAPI\Coordenada;
use Illuminate\Http\Request;
use AvisoNavAPI\CoordenadaDetalle;
use Illuminate\Support\Facades\DB;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\AyudaResource;
use AvisoNavAPI\Http\Requests\Ayuda\StoreAyuda;

class AyudaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Ayuda::with([
                        'ubicacion',
                        'coordenada',
                        'coordenada.coordenadaDetalle',
                        'coordenada.coordenadaDetalle.tipoLuz',
                        'coordenada.coordenadaDetalle.tipoColor',
                        'coordenada.coordenadaDetalle.idioma'
                        ])->get();

        return AyudaResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAyuda $request)
    {    
        $data = DB::transaction(function () use ($request) {

            //Creamos la ayuda
            $ayuda = new Ayuda($request->only(['numero', 'nombre']));
            $ayuda->version = 1;
            $ayuda->user_id = 1;
            $ayuda->ubicacion_id = $request->input('ubicacion_id');
            $ayuda->save();

            //Creamos la coordenada
            $coordenada = new Coordenada($request->only(['latitud', 'longitud', 'altitud', 'alcance', 'cantidad']));
            $coordenada->version = $ayuda->version;
            
            //Convertimos el array de detalles en una coleccion
            $collection = collect($request->input('detalle'));
            
            //Creamos una coleccion de coordenadaDetalle para asociarla a la ayuda
            $detalleCollection = $collection->map(function($item){
                
                $detalle = new CoordenadaDetalle();
                $detalle->descripcion   = $item['descripcion'];
                $detalle->observacion   = $item['observacion'];
                $detalle->tipo_luz_id   = $item['tipo_luz_id'];
                $detalle->tipo_color_id = $item['tipo_color_id'];
                $detalle->idioma_id     = $item['idioma_id'];

                return $detalle;
            });

            $ayuda->coordenada()->save($coordenada);
            $coordenada->coordenadaDetalle()->saveMany($detalleCollection);

            return $ayuda;
        });

       return new AyudaResource($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\Ayuda  $ayuda
     * @return \Illuminate\Http\Response
     */
    public function show(Ayuda $ayuda)
    {
        return new AyudaResource($ayuda);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \AvisoNavAPI\Ayuda  $ayuda
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAyuda $request, Ayuda $ayuda)
    {
        $data = DB::transaction(function () use ($request, $ayuda) {

            //Actualizamos la ayuda
            $newVersion = $ayuda->version + 1;
            $ayuda->fill($request->only(['numero', 'nombre']));
            $ayuda->version = $newVersion;
            // $ayuda->user_id = 1;
            $ayuda->ubicacion_id = $request->input('ubicacion_id');
            $ayuda->save();

            //Creamos la nueva coordenada
            $coordenada = new Coordenada($request->only(['latitud', 'longitud', 'altitud', 'alcance', 'cantidad']));
            $coordenada->version = $newVersion;
            
            //Convertimos el array de detalles en una coleccion
            $collection = collect($request->input('detalle'));
            
            //Creamos una coleccion de coordenadaDetalle para asociarla a la ayuda
            $detalleCollection = $collection->map(function($item){
                
                $detalle = new CoordenadaDetalle();
                $detalle->descripcion   = $item['descripcion'];
                $detalle->observacion   = $item['observacion'];
                $detalle->tipo_luz_id   = $item['tipo_luz_id'];
                $detalle->tipo_color_id = $item['tipo_color_id'];
                $detalle->idioma_id     = $item['idioma_id'];

                return $detalle;
            });

            $ayuda->coordenada()->save($coordenada);
            $coordenada->coordenadaDetalle()->saveMany($detalleCollection);

            return $ayuda;
        });

       return new AyudaResource($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\Ayuda  $ayuda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ayuda $ayuda)
    {
        $ayuda->delete();

        return new AyudaResource($ayuda);
    }
}
