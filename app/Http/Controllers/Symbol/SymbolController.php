<?php

namespace AvisoNavAPI\Http\Controllers\Symbol;

use AvisoNavAPI\Symbol;
use AvisoNavAPI\Coordenada;
use AvisoNavAPI\SymbolLang;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use AvisoNavAPI\ModelFilters\Basic\AidFilter;
use AvisoNavAPI\Http\Resources\SymbolResource;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\ModelFilters\Basic\SymbolFilter;

class SymbolController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\Aid\AidResource
     */
    public function index()
    {
        $collection = Symbol::filter(request()->all(), SymbolFilter::class)
                         ->with([
                             'symbolLang' => $this->withLanguageQuery(),
                             'symbolType',
                             'location'
                         ])
                         ->paginateFilter($this->perPage());

        return SymbolResource::collection($collection);
    }
}
