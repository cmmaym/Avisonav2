<?php

namespace AvisoNavAPI\Http\Controllers\TipoCaracter;

use AvisoNavAPI\TipoCaracter;
use Illuminate\Support\Facades\DB;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\TipoCaracterResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use AvisoNavAPI\Http\Requests\TipoCaracter\StoreTipoCaracter;

class TipoCaracterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\TipoCaracterResource
     */
    public function index()
    {
        $collection = TipoCaracter::where('parent_id', null)->get();

        return TipoCaracterResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\TipoCaracter\StoreTipoCaracter  $request
     * @return \AvisoNavAPI\Http\Resources\TipoCaracterResource
     */
    public function store(StoreTipoCaracter $request)
    {
        $data = DB::transaction(function () use ($request) {
            $collection = collect($request->input('tipoCaracter'));

            //Sacamos el primer elemento de la coleccion el cual sera el registro principal(master)
            $masterItem = $collection->shift();

            //Creamos la instancia del registro principal(master)
            $entity = TipoCaracter::create($masterItem);

            //Le asignamos al registro principal los otros subregistros que tendra asociado
            $collection->each(function($subItem) use ($entity){
                $entity->tipoCaracter()->create($subItem);
            });
            
            return $entity;
        });
        
        return new TipoCaracterResource($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\TipoCaracter  $tipoCaracter
     * @return \AvisoNavAPI\Http\Resources\TipoCaracterResource
     */
    public function show(TipoCaracter $tipoCaracter)
    {
        return new TipoCaracterResource($tipoCaracter);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\TipoCaracter\StoreTipoCaracter  $request
     * @param  \AvisoNavAPI\TipoCaracter $tipoCaracter
     * @return \AvisoNavAPI\Http\Resources\TipoCaracterResource
     */
    public function update(StoreTipoCaracter $request, TipoCaracter $tipoCaracter)
    {
        $data = DB::transaction(function () use ($request, $tipoCaracter) {
            $collection = collect($request->input('tipoCaracter'));
            $entityHasChange = false;
            
            /*Hacemos una copia de la instancia actual de la coleccion de los subtipoAviso
              que nos servira para hacer la aliminacion*/
            $currentCollection =  $tipoCaracter->tipoCaracter()->get()->toBase();

            //Sacamos el primer elemento de la coleccion el cual sera el registro principal(master)
            $masterItem = $collection->shift();

            //Agregamos los datos al registro principal(master)
            $tipoCaracter->fill($masterItem);

            //Verificamos si el registro se mantuvo igual o no, es decir, si fue actualizado o no
            if(!$tipoCaracter->isClean()){
                $entityHasChange = true;
            }

            //Agregamos los datos a cada uno de los subregistros que estan asociados
            $collection->each(function($subItem) use ($tipoCaracter, &$entityHasChange){
                if(isset($subItem['id'])){
                    $entity = $tipoCaracter->tipoCaracter()->where('id', $subItem['id'])->first();

                    //Si en el request viene un id que no exite lanzamos una excepcion
                    if(!$entity){
                        $e = new ModelNotFoundException();
                        $e->setModel('TipoCaracter');

                        throw $e;
                    }

                    $entity->fill($subItem);

                    //Verificamos si el subregistro se mantuvo igual o no, es decir, si fue actualizado o no
                    if(!$entity->isClean()){                        
                        $entityHasChange = true;
                    }

                }else{
                    $entity = TipoCaracter::create($subItem);
                    $entityHasChange = true;
                }

                $tipoCaracter->tipoCaracter()->save($entity);
            });

            
            //Eliminamos los subregistros que si existan en la base de datos pero que no vengan en el request
            $arrayIds = $collection->pluck('id')->toArray();
            $currentCollection->each(function($entity) use ($arrayIds, &$entityHasChange){
                if(!in_array($entity->id, $arrayIds)){
                    $entity->delete();
                    $entityHasChange = true;
                }
            });

            if(!$entityHasChange){
                return response()->json(['error' => ['title' => 'Debe por lo menos realizar un cambio para actualizar', 'status' => 422]], 422);
            }
            
            $tipoCaracter->save();

            return $tipoCaracter;
        });

        if(!$data instanceof TipoCaracter){
            return $data;
        }

       return new TipoCaracterResource($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\TipoCaracter $tipoCaracter
     * @return \AvisoNavAPI\Http\Resources\TipoCaracterResource
     */
    public function destroy(TipoCaracter $tipoCaracter)
    {
        $tipoCaracter->delete();

        return new TipoCaracterResource($tipoCaracter);
    }
}
