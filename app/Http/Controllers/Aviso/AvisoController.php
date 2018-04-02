<?php

namespace AvisoNavAPI\Http\Controllers\Aviso;

use AvisoNavAPI\Aviso;
use AvisoNavAPI\AvisoDetalle;
use AvisoNavAPI\Http\Requests\Aviso\StoreAviso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\AvisoResource;

class AvisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Aviso::with([
                        'entidad',
                        'avisoDetalle.tipoAviso',
                        'avisoDetalle.tipoCaracter',
                        'avisoDetalle.idioma',
                        'carta'
                    ])
                    ->get();

       return AvisoResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAviso $request)
    {
         $data = DB::transaction(function () use ($request) {

             //Creamos el encabezado del aviso
             $entity = Aviso::create($request->only(['num_aviso', 'fecha', 'periodo', 'entidad_id']));

             $collection = collect($request->input('aviso'));

             //Creamos una coleccion de AvisoDetalle
             $avisoDetalleCollection = $collection->map(function($item){
                return new AvisoDetalle($item);
             });

             $ayudaCollection = collect($request->input('ayuda'));

             //Transformamos la coleccion de ayudas en un array de la siguiente forma:
             //[(id de la ayuda) => ['ayuda_version' => (numero de la version)]]
             //para porder almacenarlas en la relacion de muchos a muchos usando el metodo sync
             $ayudaData = $ayudaCollection->mapWithKeys(function ($item) {
                 return [$item['id'] => ['ayuda_version' => $item['version']]];
             });

             $entity->avisoDetalle()->saveMany($avisoDetalleCollection);
             $entity->carta()->sync($request->input('carta'));
             $entity->ayuda()->sync($ayudaData);

             return $entity;
         });

        return new AvisoResource($data);

    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\Aviso  $aviso
     * @return \Illuminate\Http\Response
     */
    public function show(Aviso $aviso)
    {
        $aviso::with([
            'ayuda',
            'ayuda.coordenada' => function ($q){
                $q->join('aviso_ayuda', 'coordenada.version', '=', 'aviso_ayuda.ayuda_version');
            }
        ])        
        ->get();//->leftJoin('coordenada', 'coordenada.version', 'aviso_ayuda.ayuda_version');

        // dd($aviso->toArray());
        // dd($aviso->ayuda->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \AvisoNavAPI\Aviso  $aviso
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAviso $request, Aviso $aviso)
    {
        $data = DB::transaction(function () use ($request, $aviso) {

            $entityHasChange = false;

            $entity = $aviso->fill($request->only(['num_aviso', 'fecha', 'periodo', 'entidad_id']));

            //Verificamos si el registro se mantuvo igual o no, es decir, si fue actualizado o no
            if(!$entity->isClean()){
                $entityHasChange = true;
            }

            $collection = collect($request->input('aviso'));
            $collection->each(function($item) use (&$entityHasChange){
                $entity = AvisoDetalle::find($item['id']);
                $entity->fill($item);

                if(!$entity->isClean()){
                    $entityHasChange = true;
                }

                $entity->save();
            });

           $ayudaCollection = collect($request->input('ayuda'));

            //Transformamos la coleccion de ayudas en un array de la siguiente forma:
            //[(id de la ayuda) => ['ayuda_version' => (numero de la version)]]
            //para porder almacenarlas en la relacion de muchos a muchos usando el metodo sync
            $ayudaData = $ayudaCollection->mapWithKeys(function ($item) {
                return [$item['id'] => ['ayuda_version' => $item['version']]];
            });

            $entity->carta()->sync($request->input('carta'));
            $entity->ayuda()->sync($ayudaData);

            $entity->save();

            if(!$entityHasChange){
                return response()->json(['error' => ['title' => 'Debe por lo menos realizar un cambio para actualizar', 'status' => 422]], 422);
            }

            return $entity;
        });

        if(!$data instanceof Aviso){
            return $data;
        }

        return new AvisoResource($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\Aviso  $aviso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aviso $aviso)
    {
        $aviso->delete();

        return new AvisoResource($aviso);
    }
}
