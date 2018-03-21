<?php

namespace AvisoNavAPI\Http\Controllers\TipoColor;

use AvisoNavAPI\TipoColor;
use Illuminate\Http\Request;
use AvisoNavAPI\Consecutivo;
use Illuminate\Support\Facades\DB;
use AvisoNavAPI\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use AvisoNavAPI\Http\Resources\TipoColorResource;
use AvisoNavAPI\Http\Requests\TipoColor\StoreTipoColor;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TipoColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoColor = TipoColor::all();

        return TipoColorResource::collection($tipoColor);
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
    public function store(StoreTipoColor $request)
    {
        $entity = DB::transaction(function () use ($request) {
            $consecutivo = Consecutivo::where('nombre', 'tipo_color')->first();
            $collection = new Collection();

            foreach($request->get('tipoColor') as $item){
                $entity = new TipoColor();
        
                $entity->cod_ide = $consecutivo->numero;
                $entity->color = $item['color'];
                $entity->alias = $item['alias'];
                $entity->estado = $item['estado'];
                $entity->idioma_id = $item['idioma_id'];

                $entity->save();

                $collection->push($entity);
            }
            
            $consecutivo->numero = $consecutivo->numero + 1;
            $consecutivo->save();

            return $collection;
        });

        return TipoColorResource::collection($entity);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\TipoColor  $tipoColor
     * @return \Illuminate\Http\Response
     */
    public function show(TipoColor $tipoColor)
    {
        return new TipoColorResource($tipoColor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \AvisoNavAPI\TipoColor  $tipoColor
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoColor $tipoColor)
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
    public function update(StoreTipoColor $request, $cod_ide)
    {
        $data = DB::transaction(function () use ($request, $cod_ide) {
            
            $currentCollection = TipoColor::where('cod_ide', $cod_ide)->get();
            $newCollection = new Collection();
            $collectionHasChange = false;

            //Actualizamos o agregamos un nuevo tipo color
            foreach($request->input('tipoColor') as $item){
                $entity = null;
                if(isset($item['id'])){
                    $entity = $currentCollection->where('id', $item['id'])->first();

                    if(!$entity){
                        $e = new ModelNotFoundException();
                        $e->setModel('TipoColor');

                        throw $e;
                    }

                    $entity->fill($item);
                    
                    if(!$entity->isClean()){
                        $collectionHasChange = true;
                    }
                    
                }else{
                    $entity = new TipoColor();
                    $entity->color = $item['color'];
                    $entity->alias = $item['alias'];
                    $entity->estado = $item['estado'];
                    $entity->idioma_id = $item['idioma_id'];
                    $entity->cod_ide = $cod_ide;
                    $collectionHasChange = true;
                }
                
                $newCollection->push($entity);
                $entity->save();
            }

            //Eliminamos un tipo color si no esta presentse en el el array de tipo color que viene en el request            
            $currentCollection->each(function($entity) use ($request, &$collectionHasChange){
                if(!in_array($entity->id, $request->input('tipoColor.*.id'))){
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

        return TipoColorResource::collection($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $cod_ide
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_ide)
    {
        $currentCollection = TipoColor::where('cod_ide', $cod_ide)->get();

        $currentCollection->each(function($entity){
                $entity->delete();
        });
    }
}
