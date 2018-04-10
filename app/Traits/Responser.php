<?php

namespace AvisoNavAPI\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

trait Responser {

    private function errorResponse($message, $code){
       return response()->json(['error' => $message, 'code' => $code], $code);
    }

    protected function showAll(Collection $collection, $resource, $code = 200)
    {
        if ($collection->isEmpty()) {
            return response()->json(['data' => $collection], $code);
        }

//        $collection = $this->filterData($collection, $transformer);
        $collection = $this->sortData($collection, $resource);
        $collection = $this->paginate($collection);
//        $collection = $this->transformData($collection, $transformer);
//        $collection = $this->cacheResponse($collection);
        return $collection;
    }

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

    protected function sortData(Collection $collection, $resource)
    {
        if (request()->has('sort_by')) {
            $attribute = $resource::getOriginalAttribute(request()->sort_by);
            $collection = $collection->sortBy->{$attribute};
        }
        return $collection;
    }

}