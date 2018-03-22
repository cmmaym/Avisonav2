<?php

namespace AvisoNavAPI\Http\Controllers\Zona;

use AvisoNavAPI\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\ZonaResource;
use Illuminate\Database\Eloquent\Collection;
use AvisoNavAPI\Http\Requests\Zona\StoreZona;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ZonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\ZonaResource
     */
    public function index()
    {
        $collection = Zona::where('parent_id', null)->get();        

        return ZonaResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Zona\StoreZona  $request
     * @return \AvisoNavAPI\Http\Resources\ZonaResource
     */
    public function store(StoreZona $request)
    {        
        $data = DB::transaction(function () use ($request) {
            $collection = collect($request->input('zona'));

            //Sacamos el primer elemento de la coleccion el cual sera el registro principal(master)
            $masterItem = $collection->shift();

            //Creamos la instancia del registro principal(master)
            $entity = Zona::create($masterItem);

            //Le asignamos al registro principal los otros subregistros que tendra asociado
            $collection->each(function($subItem) use ($entity){
                $entity->zona()->create($subItem);
            });
            
            return $entity;
        });

        return new ZonaResource($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\Zona  $zona
     * @return \AvisoNavAPI\Http\Resources\ZonaResource
     */
    public function show(Zona $zona)
    {
        return new ZonaResource($zona);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Zona\StoreZona  $request
     * @param  \AvisoNavAPI\Zona  $zona
     * @return \AvisoNavAPI\Http\Resources\ZonaResource
     */
    public function update(StoreZona $request, Zona $zona)
    {
        $data = DB::transaction(function () use ($request, $zona) {
            $collection = collect($request->input('zona'));
            $entityHasChange = false;
            
            /*Hacemos una copia de la instancia actual de la coleccion de los subtipoAviso
              que nos servira para hacer la aliminacion*/
              $currentCollection =  $zona->zona()->get()->toBase();

            //Sacamos el primer elemento de la coleccion el cual sera el registro principal(master)
            $masterItem = $collection->shift();
            
            //Agregamos los datos al registro principal(master)
            $zona->fill($masterItem);

            //Verificamos si el registro se mantuvo igual o no, es decir, si fue actualizado o no
            if(!$zona->isClean()){
                $entityHasChange = true;
            }

            //Agregamos los datos a cada uno de los subregistros que estan asociados
            $collection->each(function($subItem) use ($zona, &$entityHasChange){
                if(isset($subItem['id'])){
                    $entity = $zona->zona()->where('id', $subItem['id'])->first();

                    //Si en el request viene un id que no exite lanzamos una excepcion
                    if(!$entity){
                        $e = new ModelNotFoundException();
                        $e->setModel('Zona');

                        throw $e;
                    }

                    $entity->fill($subItem);

                    //Verificamos si el subregistro se mantuvo igual o no, es decir, si fue actualizado o no
                    if(!$entity->isClean()){                        
                        $entityHasChange = true;
                    }

                }else{
                    $entity = Zona::create($subItem);
                    $entityHasChange = true;
                }

                $zona->zona()->save($entity);
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
            
            $zona->save();

            return $zona;
        });

        if(!$data instanceof Zona){
            return $data;
        }

        return new ZonaResource($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\Zona  $zona
     * @return \AvisoNavAPI\Http\Resources\ZonaResource
     */
    public function destroy(Zona $zona)
    {
        $zona->delete();

        return new ZonaResource($zona);
    }
}
