<?php

namespace AvisoNavAPI\Http\Controllers;

use AvisoNavAPI\Role;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use Illuminate\Support\Facades\Hash;
use AvisoNavAPI\Http\Resources\RoleResource;
use AvisoNavAPI\ModelFilters\Basic\RoleFilter;

class RoleController extends Controller
{
    use Filter;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Role::filter(request()->all(), RoleFilter::class)->paginateFilter($this->perPage());

        return RoleResource::collection($collection);
    }
}