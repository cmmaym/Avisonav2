<?php

namespace AvisoNavAPI\Http\Controllers\TipoCaracter;

use Illuminate\Http\Request;
use AvisoNavAPI\Consecutivo;
use AvisoNavAPI\TipoCaracter;
use Illuminate\Support\Facades\DB;
use AvisoNavAPI\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use AvisoNavAPI\Http\Resources\TipoCaracterResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use AvisoNavAPI\Http\Requests\TipoCaracter\StoreTipoCaracter;

class TipoCaracterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoCaracter = TipoCaracter::all();

        return TipoCaracterResource::collection($tipoCaracter);
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
    public function store(StoreTipoCaracter $request)
    {
        $data = DB::transaction(function () use ($request) {
            $consecutivo = Consecutivo::where('nombre', 'tipo_caracter')->first();
            $collection = new Collection();

            foreach($request->get('tipoCaracter') as $item){
                $tipoCaracter = new TipoCaracter();
        
                $tipoCaracter->cod_ide = $consecutivo->numero;
                $tipoCaracter->nombre = $item['nombre'];
                $tipoCaracter->estado = $item['estado'];
                $tipoCaracter->idioma_id = $item['idioma_id'];

                $tipoCaracter->save();

                $collection->push($tipoCaracter);
            }
            
            $consecutivo->numero = $consecutivo->numero + 1;
            $consecutivo->save();

            return $collection;
        });

        return TipoCaracterResource::collection($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\TipoCaracter  $tipoCaracter
     * @return \Illuminate\Http\Response
     */
    public function show(TipoCaracter $tipoCaracter)
    {
        return new TipoCaracterResource($tipoCaracter);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \AvisoNavAPI\TipoCaracter  $tipoCaracter
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoCaracter $tipoCaracter)
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
    public function update(StoreTipoCaracter $request, $cod_ide)
    {
        $data = DB::transaction(function () use ($request, $cod_ide) {
            
            $currentCollection = TipoCaracter::where('cod_ide', $cod_ide)->get();            
            $newCollection = new Collection();
            $collectionHasChange = false;

            //Actualizamos o agregamos un nuevo tipo caracter
            foreach($request->input('tipoCaracter') as $item){
                $entity = null;
                if(isset($item['tipo_carac_id'])){
                    $entity = $currentCollection->where('tipo_carac_id', $item['tipo_carac_id'])->first();

                    if(!$entity){
                        $e = new ModelNotFoundException();
                        $e->setModel('TipoCaracter');

                        throw $e;
                    }

                    $entity->fill($item);
                    
                    if(!$entity->isClean()){
                        $collectionHasChange = true;
                    }
                    
                }else{
                    $entity = new TipoCaracter();
                    $entity->nombre = $item['nombre'];
                    $entity->estado = $item['estado'];
                    $entity->idioma_id = $item['idioma_id'];
                    $entity->cod_ide = $cod_ide;
                    $collectionHasChange = true;
                }
                
                $newCollection->push($entity);
                $entity->save();
            }

            //Eliminamos un tipo caracter si no esta presentse en el el array de tipo caracter que viene en el request            
            $currentCollection->each(function($entity) use ($request, &$collectionHasChange){
                if(!in_array($entity->tipo_carac_id, $request->input('tipoCaracter.*.tipo_carac_id'))){
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

        return TipoCaracterResource::collection($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $cod_ide
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_ide)
    {
        $currentCollection = TipoCaracter::where('cod_ide', $cod_ide)->get();

        $currentCollection->each(function($entity){
                $entity->delete();
        });
    }
}
