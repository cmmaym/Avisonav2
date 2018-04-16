<?php

namespace AvisoNavAPI\Http\Controllers\TypeNotice;

use AvisoNavAPI\TypeNotice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\TypeNoticeResource;
use AvisoNavAPI\Http\Requests\TypeNotice\StoreTypeNotice;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TypeNoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\TypeNoticeResource
     */
    public function index()
    {
        $collection = TypeNotice::where('parent_id', null)->get();

        return TypeNoticeResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\TypeNotice\StoreTypeNotice  $request
     * @return \AvisoNavAPI\Http\Resources\TypeNoticeResource
     */
    public function store(StoreTypeNotice $request)
    {        
        $data = DB::transaction(function () use ($request) {
            $collection = collect($request->input('TypeNotice'));

            //Sacamos el primer elemento de la coleccion el cual sera el registro principal(master)
            $masterItem = $collection->shift();

            //Creamos la instancia del registro principal(master)
            $entity = TypeNotice::create($masterItem);

            //Le asignamos al registro principal los otros subregistros que tendra asociado
            $collection->each(function($subItem) use ($entity){
                $entity->TypeNotice()->create($subItem);
            });
            
            return $entity;
        });
        
        return new TypeNoticeResource($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\TypeNotice  typeNotice
     * @return \AvisoNavAPI\Http\Resources\TypeNoticeResource
     */
    public function show(TypeNotice $typeNotice)
    {        
        return new TypeNoticeResource(typeNotice);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\TypeNotice\StoreTypeNotice  $request
     * @param  \AvisoNavAPI\TypeNotice    typeNotice
     * @return \AvisoNavAPI\Http\Resources\TypeNoticeResource
     */
    public function update(StoreTypeNotice $request, TypeNotice $typeNotice)
    {        
        $data = DB::transaction(function () use ($request, typeNotice) {
            $collection = collect($request->input('TypeNotice'));
            $entityHasChange = false;
            
            /*Hacemos una copia de la instancia actual de la coleccion de los subTypeNotice
              que nos servira para hacer la aliminacion*/
            $currentCollection =  typeNotice->TypeNotice()->get()->toBase();

            //Sacamos el primer elemento de la coleccion el cual sera el registro principal(master)
            $masterItem = $collection->shift();

            //Agregamos los datos al registro principal(master)
            typeNotice->fill($masterItem);

            //Verificamos si el registro se mantuvo igual o no, es decir, si fue actualizado o no
            if(!typeNotice->isClean()){
                $entityHasChange = true;
            }

            //Agregamos los datos a cada uno de los subregistros que estan asociados
            $collection->each(function($subItem) use (typeNotice, &$entityHasChange){
                if(isset($subItem['id'])){
                    $entity = typeNotice->TypeNotice()->where('id', $subItem['id'])->first();

                    //Si en el request viene un id que no exite lanzamos una excepcion
                    if(!$entity){
                        $e = new ModelNotFoundException();
                        $e->setModel('TypeNotice');

                        throw $e;
                    }

                    $entity->fill($subItem);

                    //Verificamos si el subregistro se mantuvo igual o no, es decir, si fue actualizado o no
                    if(!$entity->isClean()){                        
                        $entityHasChange = true;
                    }

                }else{
                    $entity = TypeNotice::create($subItem);
                    $entityHasChange = true;
                }

                typeNotice->TypeNotice()->save($entity);
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
            
            typeNotice->save();

            return typeNotice;
        });

        if(!$data instanceof TypeNotice){
            return $data;
        }

       return new TypeNoticeResource($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\TypeNotice    typeNotice
     * @return \AvisoNavAPI\Http\Resources\TypeNoticeResource
     */
    public function destroy(Request $request, TypeNotice typeNotice)
    {        
        typeNotice->delete();

        return new TypeNoticeResource(typeNotice);
    }
}