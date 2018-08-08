<?php

namespace AvisoNavAPI\Http\Controllers\Aid;

use AvisoNavAPI\Aid;
use AvisoNavAPI\ColorStructure;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use AvisoNavAPI\Http\Resources\ColorStructure\ColorStructureResource;
use AvisoNavAPI\ModelFilters\Basic\ColorStructureFilter;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;

class AidColorStructureController extends Controller
{

    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Aid $aid)
    {
        $collection = $aid->aidColorStructure()->filter(request()->all(), ColorStructureFilter::class)
                                   ->with([
                                       'colorStructureLang' => $this->withLanguageQuery()
                                   ])
                                   ->paginateFilter($this->perPage());;

        return ColorStructureResource::collection($collection);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Aid $aid, ColorStructure $colorStructure)
    {
        $aid->aidColorStructure()->attach($colorStructure->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aid $aid, ColorStructure $colorStructure)
    {
        $aid->aidColorStructure()->detach($colorStructure->id);
    }
}
