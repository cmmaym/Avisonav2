<?php

namespace AvisoNavAPI\Http\Controllers\TipoAviso;

use AvisoNavAPI\TipoAviso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\TipoAvisoResource;
use AvisoNavAPI\Http\Requests\TipoAviso\StoreTipoAviso;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TipoAvisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\TipoAvisoResource
     */
    public function index()
    {
        $collection = TipoAviso::where('parent_id', null)->get();

        return TipoAvisoResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\TipoAviso\StoreTipoAviso  $request
     * @return \AvisoNavAPI\Http\Resources\TipoAvisoResource
     */
    public function store(StoreTipoAviso $request)
    {        
        $data = DB::transaction(function () use ($request) {
            $collection = collect($request->input('tipoAviso'));

            //Sacamos el primer elemento de la coleccion el cual sera el registro principal(master)
            $masterItem = $collection->shift();

            //Creamos la instancia del registro principal(master)
            $entity = TipoAviso::create($masterItem);

            //Le asignamos al registro principal los otros subregistros que tendra asociado
            $collection->each(function($subItem) use ($entity){
                $entity->tipoAviso()->create($subItem);
            });
            
            return $entity;
        });
        
        return new TipoAvisoResource($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\TipoAviso  $tipoAviso
     * @return \AvisoNavAPI\Http\Resources\TipoAvisoResource
     */
    public function show(TipoAviso $tipoAviso)
    {        
        return new TipoAvisoResource($tipoAviso);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\TipoAviso\StoreTipoAviso  $request
     * @param  \AvisoNavAPI\TipoAviso    $tipoAviso
     * @return \AvisoNavAPI\Http\Resources\TipoAvisoResource
     */
    public function update(StoreTipoAviso $request, TipoAviso $tipoAviso)
    {        
        $data = DB::transaction(function () use ($request, $tipoAviso) {
            $collection = collect($request->input('tipoAviso'));
            $entityHasChange = false;
            
            /*Hacemos una copia de la instancia actual de la coleccion de los subtipoAviso
              que nos servira para hacer la aliminacion*/
            $currentCollection =  $tipoAviso->tipoAviso()->get()->toBase();

            //Sacamos el primer elemento de la coleccion el cual sera el registro principal(master)
            $masterItem = $collection->shift();

            //Agregamos los datos al registro principal(master)
            $tipoAviso->fill($masterItem);

            //Verificamos si el registro se mantuvo igual o no, es decir, si fue actualizado o no
            if(!$tipoAviso->isClean()){
                $entityHasChange = true;
            }

            //Agregamos los datos a cada uno de los subregistros que estan asociados
            $collection->each(function($subItem) use ($tipoAviso, &$entityHasChange){
                if(isset($subItem['id'])){
                    $entity = $tipoAviso->tipoAviso()->where('id', $subItem['id'])->first();

                    //Si en el request viene un id que no exite lanzamos una excepcion
                    if(!$entity){
                        $e = new ModelNotFoundException();
                        $e->setModel('TipoAviso');

                        throw $e;
                    }

                    $entity->fill($subItem);

                    //Verificamos si el subregistro se mantuvo igual o no, es decir, si fue actualizado o no
                    if(!$entity->isClean()){                        
                        $entityHasChange = true;
                    }

                }else{
                    $entity = TipoAviso::create($subItem);
                    $entityHasChange = true;
                }

                $tipoAviso->tipoAviso()->save($entity);
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
            
            $tipoAviso->save();

            return $tipoAviso;
        });

        if(!$data instanceof TipoAviso){
            return $data;
        }

       return new TipoAvisoResource($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\TipoAviso    $tipoAviso
     * @return \AvisoNavAPI\Http\Resources\TipoAvisoResource
     */
    public function destroy(Request $request, TipoAviso $tipoAviso)
    {        
        $tipoAviso->delete();

        return new TipoAvisoResource($tipoAviso);
    }
}