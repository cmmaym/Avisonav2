<?php

namespace AvisoNavAPI\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

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
     * @return \Illuminate\Support\Collection
     */
    protected function showAll(Collection $collection, $resource, $code = 200)
    {
        if ($collection->isEmpty()) {
            return response()->json(['data' => $collection], $code);
        }

        $collection = $this->filterData($collection, $resource);
        $collection = $this->sortData($collection, $resource);
        $collection = $this->paginate($collection);

        return $collection;
    }

	/**
     * This method receive collection and apply a paginator
     *
     * @return \Illuminate\Support\Collection
     */
    protected function paginate(Collection $collection)
	{
		$rules = [
			'per_page' => 'integer|min:2|max:50'
        ];
        
        Validator::validate(request()->all(), $rules);
        
		$page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 15;
        
		if (request()->has('per_page')) {
			$perPage = (int) request()->per_page;
        }
        
		$results = $collection->slice(($page - 1) * $perPage, $perPage)->values();
		$paginated = new LengthAwarePaginator($results, $collection->count(), $perPage, $page, [
			'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);
        
        $paginated->appends(request()->all());
        
		return $paginated;
	}

	/**
     * Sort the collection using url parameter
     *
     * @return \Illuminate\Support\Collection
     */
    protected function sortData(Collection $collection, $resource)
    {
        if (request()->has('sort_by')) {
            $attribute = $resource::getOriginalAttribute(request()->sort_by);
            $collection = $collection->sortBy->{$attribute};
        }
        return $collection;
	}
	
	/**
     * Filter the collection using url parameter
     *
     * @return \Illuminate\Support\Collection
     */
	protected function filterData(Collection $collection, $resource)
	{
		foreach (request()->query() as $query => $value) {
			$attribute = $resource::getOriginalAttribute($query);
			if (isset($attribute, $value)) {
				$collection = $collection->where($attribute, $value);
			}
		}
		return $collection;
	}

}