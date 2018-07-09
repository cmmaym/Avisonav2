<?php

namespace AvisoNavAPI\Http\Controllers\Entity;

use AvisoNavAPI\Entity;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Http\Resources\EntityResource;
use AvisoNavAPI\ModelFilters\Basic\EntityFilter;
use AvisoNavAPI\Http\Requests\Entity\StoreEntity;
use AvisoNavAPI\Traits\Responser;

class EntityController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\EntityResource
     */
    public function index()
    {
        $collection  =   Entity::filter(request()->all(), EntityFilter::class)->paginateFilter($this->perPage());

        return EntityResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Entity\StoreEntity  $request
     * @return \AvisoNavAPI\Http\Resources\EntityResource
     */
    public function store(StoreEntity $request)
    {
        $entity = Entity::create($request->only(['name','alias','state']));

        return new EntityResource($entity);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\Entity  $entity
     * @return \AvisoNavAPI\Http\Resources\EntityResource
     */
    public function show(Entity $entity)
    {
        return new EntityResource($entity);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Entity\StoreEntity  $request
     * @param  \AvisoNavAPI\Entity  $entity
     * @return \AvisoNavAPI\Http\Resources\EntityResource
     */
    public function update(StoreEntity $request, Entity $entity)
    {
        $entity->fill($request->only(['name','alias','state',]));
        
        if($entity->isClean()){
            return $this->errorResponse('Debe espesificar por lo menos un valor diferente para actualizar', 409);
        }
        
        $entity->save();
        
        return new EntityResource($entity);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\Entity  $entity
     * @return \AvisoNavAPI\Http\Resources\EntityResource
     */
    public function destroy(Entity $entity)
    {
        $entity->delete();

        return new EntityResource($entity);
    }
}
