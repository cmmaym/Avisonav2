<?php

namespace AvisoNavAPI\Http\Controllers\TipoLuz;

use AvisoNavAPI\TipoLuz;
use Illuminate\Http\Request;
use AvisoNavAPI\Consecutivo;
use Illuminate\Support\Facades\DB;
use AvisoNavAPI\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use AvisoNavAPI\Http\Resources\TipoLuzResource;
use AvisoNavAPI\Http\Requests\TipoLuz\StoreTipoLuz;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TipoLuzController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoLuz = TipoLuz::all();

        return TipoLuzResource::collection($tipoLuz);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTipoLuz $request)
    {
        $entity = DB::transaction(function () use ($request) {
            $consecutivo = Consecutivo::where('nombre', 'tipo_luz')->first();
            $collection = new Collection();

            foreach($request->get('tipoLuz') as $item){
                $entity = new TipoLuz();
        
                $entity->cod_ide = $consecutivo->numero;
                $entity->clase = $item['clase'];
                $entity->alias = $item['alias'];
                $entity->descripcion = $item['descripcion'];
                $entity->illustracion = $item['illustracion'];
                $entity->estado = $item['estado'];
                $entity->idioma_id = $item['idioma_id'];

                $entity->save();

                $collection->push($entity);
            }
            
            $consecutivo->numero = $consecutivo->numero + 1;
            $consecutivo->save();

            return $collection;
        });

        return TipoLuzResource::collection($entity);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\TipoLuz  $tipoLuz
     * @return \Illuminate\Http\Response
     */
    public function show(TipoLuz $tipoLuz)
    {
        return new TipoLuzResource($tipoLuz);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \AvisoNavAPI\TipoLuz  $tipoLuz
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoLuz $tipoLuz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $cod_ide
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTipoLuz $request, $cod_ide)
    {
        $data = DB::transaction(function () use ($request, $cod_ide) {
            
            $currentCollection = TipoLuz::where('cod_ide', $cod_ide)->get();
            $newCollection = new Collection();
            $collectionHasChange = false;

            //Actualizamos o agregamos un nuevo tipo color
            foreach($request->input('tipoLuz') as $item){
                $entity = null;
                if(isset($item['id'])){
                    $entity = $currentCollection->where('id', $item['id'])->first();

                    if(!$entity){
                        $e = new ModelNotFoundException();
                        $e->setModel('TipoLuz');

                        throw $e;
                    }

                    $entity->fill($item);
                    
                    if(!$entity->isClean()){
                        $collectionHasChange = true;
                    }
                    
                }else{
                    $entity = new TipoLuz();
                    $entity->clase = $item['clase'];
                    $entity->alias = $item['alias'];
                    $entity->descripcion = $item['descripcion'];
                    $entity->illustracion = $item['illustracion'];
                    $entity->estado = $item['estado'];
                    $entity->idioma_id = $item['idioma_id'];
                    $entity->cod_ide = $cod_ide;
                    $collectionHasChange = true;
                }
                
                $newCollection->push($entity);
                $entity->save();
            }

            //Eliminamos un tipo luz si no esta presentse en el el array de tipo luz que viene en el request            
            $currentCollection->each(function($entity) use ($request, &$collectionHasChange){
                if(!in_array($entity->id, $request->input('tipoLuz.*.id'))){
                    $entity->delete();
                    $collectionHasChange = true;
                }
            });

            if(!$collectionHasChange){
                return response()->json(['error' => ['title' => 'Debe espesificar por lo menos un valor diferente para actualizar', 'status' => 422]], 422);
            }

            return $newCollection;
        });

        if(!$data instanceof Collection){
            return $data;
        }

        return TipoLuzResource::collection($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_ide)
    {
        $currentCollection = TipoLuz::where('cod_ide', $cod_ide)->get();

        $currentCollection->each(function($entity){
                $entity->delete();
        });
    }
    
}
