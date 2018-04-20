<?php

namespace AvisoNavAPI\Http\Controllers\Notice;

use Illuminate\Http\Request;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Notice;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\ModelFilters\Basic\AidFilter;
use AvisoNavAPI\Http\Resources\AidResource;

class NoticeAidController extends Controller
{
    use Filter;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Notice $notice)
    {
        $collection = $notice->aid()->filter(request()->all(), AidFilter::class)->paginateFilter($this->perPage());

        return AidResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

}
