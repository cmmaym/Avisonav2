<?php

namespace AvisoNavAPI\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait Responser {

	 /**
     * Create error response in json format
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function errorResponse($message, $code){
       return response()->json(['error' => $message, 'code' => $code], $code);
    }

	/**
     * Set collection using filter data, sort data and paginate data
     * 
     * @param mixed $query
     * @param string $resource
     * @param int $code
     * 
     * @return \Illuminate\Support\Collection
     */
    protected function showAll($query, $resourceClass, $url = null, $code = 200)
    {
    
        $this->filterData($query, $resourceClass);
        $this->sortData($query, $resourceClass);

        $collection = $this->paginate($query, $url);

        if ($collection->isEmpty()) {
            return response()->json(['data' => $collection], $code);
            // throw new NotFoundHttpException();
        }

        return $collection;
    }

    protected function paginate($query, $url = null)
    {

        $rules = [
			'per_page' => 'integer|min:2|max:50'
        ];
        
        Validator::validate(request()->all(), $rules);
		
        $perPage = 3;
		if (request()->has('per_page')) {
			$perPage = (int) request()->per_page;
        }

        $collection = $query->paginate($perPage);

        if(!is_null($url)) $collection->setPath($url);

        return $collection;

    }

	/**
     * This method receive collection and apply a paginator
     *
     * @return \Illuminate\Support\Collection
     */
    protected function manualPaginate(Collection $collection, $url = null )
	{
		$rules = [
			'per_page' => 'integer|min:2|max:50'
        ];
        
        Validator::validate(request()->all(), $rules);
        
		$page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 3;
        
		if (request()->has('per_page')) {
			$perPage = (int) request()->per_page;
        }
        
        $path = (!is_null($url)) ? $url : LengthAwarePaginator::resolveCurrentPath();

		$results = $collection->slice(($page - 1) * $perPage, $perPage)->values();
		$paginated = new LengthAwarePaginator($results, $collection->count(), $perPage, $page, [
			'path' => $path,
        ]);
        
        $paginated->appends(request()->all());
        
		return $paginated;
	}

	/**
     * Sort the collection using url parameter
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $resource
     *
     */
    protected function sortData($query, $resource)
    {
        if (request()->has('sort_by')) {
            $attribute = $resource::getOriginalAttribute(request()->sort_by);
            
            $order = request()->has('order') ? request()->order : 'asc';

            $query->orderBy($attribute, $order);
        }
	}
	
	/**
     * Filter the collection using url parameter
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $resource
     */
	protected function filterData($query, $resource)
	{
		foreach (request()->query() as $item => $value) {
			$attribute = $resource::getOriginalAttribute($item);
			if (isset($attribute, $value)) {
                $query->where($attribute, $value);
			}
        }	
    }

}