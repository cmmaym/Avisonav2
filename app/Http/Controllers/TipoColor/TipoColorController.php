<?php

namespace AvisoNavAPI\Http\Controllers\TipoColor;

use AvisoNavAPI\TipoColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\TipoColorResource;
use AvisoNavAPI\Http\Requests\TipoColor\StoreTipoColor;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TipoColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\TipoColorResource
     */
    public function index()
    {
        $collection = TipoColor::where('parent_id', null)->get();

        return TipoColorResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\TipoColor\StoreTipoColor  $request
     * @return \AvisoNavAPI\Http\Resources\TipoColorResource
     */
    public function store(StoreTipoColor $request)
    {
        $data = DB::transaction(function () use ($request) {
            $collection = collect($request->input('tipoColor'));

            //Sacamos el primer elemento de la coleccion el cual sera el registro principal(master)
            $masterItem = $collection->shift();

            //Creamos la instancia del registro principal(master)
            $entity = TipoColor::create($masterItem);

            //Le asignamos al registro principal los otros subregistros que tendra asociado
            $collection->each(function($subItem) use ($entity){
                $entity->tipoColor()->create($subItem);
            });
            
            return $entity;
        });
        
        return new TipoColorResource($data);        
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\TipoColor  $tipoColor
     * @return \AvisoNavAPI\Http\Resources\TipoColorResource
     */
    public function show(TipoColor $tipoColor)
    {
        return new TipoColorResource($tipoColor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\TipoColor\StoreTipoColor  $request
     * @param  \AvisoNavAPI\TipoColor $tipoColor
     * @return \AvisoNavAPI\Http\Resources\TipoColorResource
     */
    public function update(StoreTipoColor $request, TipoColor $tipoColor)
    {
        $data = DB::transaction(function () use ($request, $tipoColor) {
            $collection = collect($request->input('tipoColor'));
            $entityHasChange = false;
            
            /*Hacemos una copia de la instancia actual de la coleccion de los subtipoAviso
              que nos servira para hacer la aliminacion*/
            $currentCollection =  $tipoColor->tipoColor()->get()->toBase();

            //Sacamos el primer elemento de la coleccion el cual sera el registro principal(master)
            $masterItem = $collection->shift();

            //Agregamos los datos al registro principal(master)
            $tipoColor->fill($masterItem);

            //Verificamos si el registro se mantuvo igual o no, es decir, si fue actualizado o no
            if(!$tipoColor->isClean()){
                $entityHasChange = true;
            }

            //Agregamos los datos a cada uno de los subregistros que estan asociados
            $collection->each(function($subItem) use ($tipoColor, &$entityHasChange){
                if(isset($subItem['id'])){
                    $entity = $tipoColor->tipoColor()->where('id', $subItem['id'])->first();

                    //Si en el request viene un id que no exite lanzamos una excepcion
                    if(!$entity){
                        $e = new ModelNotFoundException();
                        $e->setModel('TipoColor');

                        throw $e;
                    }

                    $entity->fill($subItem);

                    //Verificamos si el subregistro se mantuvo igual o no, es decir, si fue actualizado o no
                    if(!$entity->isClean()){                        
                        $entityHasChange = true;
                    }

                }else{
                    $entity = TipoColor::create($subItem);
                    $entityHasChange = true;
                }

                $tipoColor->tipoColor()->save($entity);
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
            
            $tipoColor->save();

            return $tipoColor;
        });

        if(!$data instanceof TipoColor){
            return $data;
        }

        return new TipoColorResource($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\TipoColor $tipoColor
     * @return \AvisoNavAPI\Http\Resources\TipoColorResource
     */
    public function destroy(TipoColor $tipoColor)
    {
        $tipoColor->delete();

        return new TipoColorResource($tipoColor);
    }
}
