<?php

namespace AvisoNavAPI\Http\Controllers\Notice;

use Illuminate\Http\Request;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Notice;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\ModelFilters\Basic\AidFilter;
use AvisoNavAPI\Http\Resources\Aid\AidResource;
use AvisoNavAPI\Aid;

class NoticeAidController extends Controller
{
    use Filter;

    public function __construct()
    {
        if(!request()->exists('language')) request()->merge(['language' => '1']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\Aid\AidResource
     */
    public function index(Notice $notice)
    {
        $language = request()->input('language');
        $collection = $notice->aid()->filter(request()->all(), AidFilter::class)
                                    ->with([
                                        'coordinate',
                                        'aidLang' => function($query) use ($language){
                                        $query->where('language_id', $language);
                                        },
                                        'location.zone.zoneLang' => function($query) use ($language){
                                        $query->where('language_id', $language);
                                        },
                                        'lightType.lightTypeLang' => function($query) use ($language){
                                        $query->where('language_id', $language);
                                        },
                                        'colorType.colorTypeLang' => function($query) use ($language){
                                        $query->where('language_id', $language);
                                        },
                                        'aidType.aidTypeLang' => function($query) use ($language){
                                        $query->where('language_id', $language);
                                        }
                                    ])
                                    ->paginateFilter($this->perPage());

        return AidResource::collection($collection);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Notice $notice
     * @param  \AvisoNavAPI\Aid $aid
     * @return \Illuminate\Http\Response
     */
    public function update(Notice $notice, Aid $aid)
    {
        $notice->aid()->attach($aid->id, ['coordinate_id' => request()->input('coordinate_id')]);
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
