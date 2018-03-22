<?php

namespace AvisoNavAPI\Http\Controllers\TipoLuz;

use AvisoNavAPI\TipoLuz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\TipoLuzResource;
use AvisoNavAPI\Http\Requests\TipoLuz\StoreTipoLuz;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TipoLuzController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\TipoLuzResource
     */
    public function index()
    {
        $collection = TipoLuz::where('parent_id', null)->get();

        return TipoLuzResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\TipoLuz\StoreTipoLuz  $request
     * @return \AvisoNavAPI\Http\Resources\TipoLuzResource
     */
    public function store(StoreTipoLuz $request)
    {
        $data = DB::transaction(function () use ($request) {
            $collection = collect($request->input('tipoLuz'));

            //Sacamos el primer elemento de la coleccion el cual sera el registro principal(master)
            $masterItem = $collection->shift();

            //Creamos la instancia del registro principal(master)
            $entity = TipoLuz::create($masterItem);

            //Le asignamos al registro principal los otros subregistros que tendra asociado
            $collection->each(function($subItem) use ($entity){
                $entity->tipoLuz()->create($subItem);
            });
            
            return $entity;
        });
        
        return new TipoLuzResource($data); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\TipoLuz  $tipoLuz
     * @return \AvisoNavAPI\Http\Resources\TipoLuzResource
     */
    public function show(TipoLuz $tipoLuz)
    {
        return new TipoLuzResource($tipoLuz);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\TipoLuz\StoreTipoLuz  $request
     * @param  \AvisoNavAPI\TipoLuz $tipoLuz
     * @return \AvisoNavAPI\Http\Resources\TipoLuzResource
     */
    public function update(StoreTipoLuz $request, TipoLuz $tipoLuz)
    {
        $data = DB::transaction(function () use ($request, $tipoLuz) {
            $collection = collect($request->input('tipoLuz'));
            $entityHasChange = false;
            
            /*Hacemos una copia de la instancia actual de la coleccion de los subtipoAviso
              que nos servira para hacer la aliminacion*/
            $currentCollection =  $tipoLuz->tipoLuz()->get()->toBase();

            //Sacamos el primer elemento de la coleccion el cual sera el registro principal(master)
            $masterItem = $collection->shift();

            //Agregamos los datos al registro principal(master)
            $tipoLuz->fill($masterItem);

            //Verificamos si el registro se mantuvo igual o no, es decir, si fue actualizado o no
            if(!$tipoLuz->isClean()){
                $entityHasChange = true;
            }

            //Agregamos los datos a cada uno de los subregistros que estan asociados
            $collection->each(function($subItem) use ($tipoLuz, &$entityHasChange){
                if(isset($subItem['id'])){
                    $entity = $tipoLuz->tipoLuz()->where('id', $subItem['id'])->first();

                    //Si en el request viene un id que no exite lanzamos una excepcion
                    if(!$entity){
                        $e = new ModelNotFoundException();
                        $e->setModel('TipoLuz');

                        throw $e;
                    }

                    $entity->fill($subItem);

                    //Verificamos si el subregistro se mantuvo igual o no, es decir, si fue actualizado o no
                    if(!$entity->isClean()){                        
                        $entityHasChange = true;
                    }

                }else{
                    $entity = TipoLuz::create($subItem);
                    $entityHasChange = true;
                }

                $tipoLuz->tipoLuz()->save($entity);
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
            
            $tipoLuz->save();

            return $tipoLuz;
        });

        if(!$data instanceof TipoLuz){
            return $data;
        }

        return new TipoLuzResource($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\TipoLuz $tipoLuz
     * @return \AvisoNavAPI\Http\Resources\TipoLuzResource
     */
    public function destroy(TipoLuz $tipoLuz)
    {
        $tipoLuz->delete();

        return new TipoLuzResource($tipoLuz);
    }
    
}
