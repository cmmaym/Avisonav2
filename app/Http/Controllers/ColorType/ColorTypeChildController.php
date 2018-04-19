<?php

namespace AvisoNavAPI\Http\Controllers\ColorType;

use AvisoNavAPI\ColorType;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\ColorTypeResource;
use AvisoNavAPI\ModelFilters\Basic\ColorTypeFilter;
use AvisoNavAPI\Traits\Responser;
use AvisoNavAPI\Http\Requests\ColorType\StoreColorType;

class ColorTypeChildController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ColorType $colorType)
    {
        $collection = $colorType->colorType()->filter(request()->all(), ColorTypeFilter::class)->paginateFilter($this->perPage());

        return ColorTypeResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreColorType $request, ColorType $colorType)
    {
        $this->validateChildLanguage($colorType->language_id);

        $childColorType = new ColorType($request->only(['color', 'alias', 'state']));
        $childColorType->language_id = $request->input('language_id');

        $colorType->colorType()->save($childColorType);

        return new ColorTypeResource($childColorType);
    }

}
