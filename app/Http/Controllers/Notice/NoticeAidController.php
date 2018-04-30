<?php

namespace AvisoNavAPI\Http\Controllers\Notice;

use Illuminate\Http\Request;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Notice;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\ModelFilters\Basic\AidFilter;
use AvisoNavAPI\Http\Resources\AidResource;
use AvisoNavAPI\Aid;

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
        $request = request();
        $collection = $notice->aid()->filter(request()->all(), AidFilter::class)
                                    ->with([
                                        'aidLang' => function($query) use ($request){
                                            // if($request->has('language')){
                                            //     $query->where('language_id', $request->input('language'));
                                            // }
                                        }
                                    ])
                                    ->paginateFilter($this->perPage());

        return AidResource::collection($collection);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Notice $notice, Aid $aid)
    {
        $notice->aid()->attach($aid->id, ['aid_detail_id' => request()->input('aidDetail')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notice $notice, Aid $aid)
    {
        $notice->aid()->detach($aid->id);
    }

}
