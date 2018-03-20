<?php

namespace AvisoNavAPI\Http\Controllers\Zona;

use AvisoNavAPI\Zona;
use Illuminate\Http\Request;
use AvisoNavAPI\Consecutivo;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zona = Zona::all();

        return ZonaResource::collection($zona);
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
    public function store(StoreZona $request)
    {
        $entity = DB::transaction(function () use ($request) {
            $consecutivo = Consecutivo::where('nombre', 'zona')->first();
            $collection = new Collection();

            foreach($request->get('zona') as $item){
                $entity = new Zona();
        
                $entity->cod_ide = $consecutivo->numero;
                $entity->nombre = $item['nombre'];
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

        return ZonaResource::collection($entity);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function show(Zona $zona)
    {
        return new ZonaResource($zona);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \AvisoNavAPI\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function edit(Zona $zona)
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
    public function update(StoreZona $request, $cod_ide)
    {
        $data = DB::transaction(function () use ($request, $cod_ide) {
            
            $currentCollection = Zona::where('cod_ide', $cod_ide)->get();
            $newCollection = new Collection();
            $collectionHasChange = false;

            //Actualizamos o agregamos una nueva zona
            foreach($request->input('zona') as $item){
                $entity = null;
                if(isset($item['zona_id'])){
                    $entity = $currentCollection->where('zona_id', $item['zona_id'])->first();

                    if(!$entity){                        
                        $e = new ModelNotFoundException();
                        $e->setModel('Zona');

                        throw $e;
                    }

                    $entity->fill($item);
                    
                    if(!$entity->isClean()){
                        $collectionHasChange = true;
                    }
                    
                }else{
                    $entity = new Zona();
                    $entity->nombre = $item['nombre'];
                    $entity->alias = $item['alias'];
                    $entity->estado = $item['estado'];
                    $entity->idioma_id = $item['idioma_id'];
                    $entity->cod_ide = $cod_ide;
                    $collectionHasChange = true;
                }
                
                $newCollection->push($entity);
                $entity->save();
            }

            //Eliminamos una zona si no esta presentse en el el array de zonas que viene en el request            
            $currentCollection->each(function($entity) use ($request, &$collectionHasChange){
                if(!in_array($entity->zona_id, $request->input('zona.*.zona_id'))){
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

        return ZonaResource::collection($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $cod_ide
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_ide)
    {
        $currentCollection = Zona::where('cod_ide', $cod_ide)->get();

        $currentCollection->each(function($entity){
                $entity->delete();
        });
    }
}
