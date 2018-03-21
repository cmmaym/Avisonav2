<?php

namespace AvisoNavAPI\Http\Controllers\TipoAviso;

use AvisoNavAPI\TipoAviso;
use AvisoNavAPI\Consecutivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use AvisoNavAPI\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Response;
use AvisoNavAPI\Http\Resources\TipoAvisoResource;
use AvisoNavAPI\Http\Requests\TipoAviso\StoreTipoAviso;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TipoAvisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiposAviso = TipoAviso::where('parent_id', null)->get();

        return TipoAvisoResource::collection($tiposAviso);
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
    public function store(Request $request)
    {        
        $data = DB::transaction(function () use ($request) {
            $collection = collect($request->input('tipoAviso'));

            //Sacamos el primer elemento de la coleccion el cual sera el tipoAviso principal(master)
            $masterItem = $collection->shift();

            //Creamos el tipo aviso principal(master)
            $entity = TipoAviso::create($masterItem);

            //Le asignamos al tipoAviso principal los otros tipoAviso que tendra asociado
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
     * @return \Illuminate\Http\Response
     */
    public function show(TipoAviso $tipoAviso)
    {
        return new TipoAvisoResource($tipoAviso);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \AvisoNavAPI\TipoAviso  $tipoAviso
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoAviso $tipoAviso)
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
    public function update(StoreTipoAviso $request, $cod_ide)
    {      
        
        $data = DB::transaction(function () use ($request, $cod_ide) {
            
            $currentCollection = TipoAviso::where('cod_ide', $cod_ide)->get();            
            $newCollection = new Collection();
            $collectionHasChange = false;

            //Actualizamos o agregamos un nuevo tipo aviso
            foreach($request->input('tipoAviso') as $item){
                $entity = null;
                if(isset($item['tipo_aviso_id'])){
                    $entity = $currentCollection->where('tipo_aviso_id', $item['tipo_aviso_id'])->first();

                    if(!$entity){
                        $e = new ModelNotFoundException();
                        $e->setModel('TipoAviso');

                        throw $e;
                    }

                    $entity->fill($item);
                    
                    if(!$entity->isClean()){
                        $collectionHasChange = true;
                    }
                    
                }else{
                    $entity = new TipoAviso();
                    $entity->nombre = $item['nombre'];
                    $entity->estado = $item['estado'];
                    $entity->idioma_id = $item['idioma_id'];
                    $entity->cod_ide = $cod_ide;
                    $collectionHasChange = true;
                }
                
                $newCollection->push($entity);
                $entity->save();
            }

            //Eliminamos un tipo aviso si no esta presentse en el el array de tipo aviso que viene en el request            
            $currentCollection->each(function($entity) use ($request, &$collectionHasChange){
                if(!in_array($entity->tipo_aviso_id, $request->input('tipoAviso.*.tipo_aviso_id'))){
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

        return TipoAvisoResource::collection($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $cod_ide
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $cod_ide)
    {        
        $currentCollection = TipoAviso::where('cod_ide', $cod_ide)->get();

        $currentCollection->each(function($entity){
                $entity->delete();
        });
    }
}