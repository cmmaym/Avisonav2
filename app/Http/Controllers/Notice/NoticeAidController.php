<?php

namespace AvisoNavAPI\Http\Controllers\Notice;

use Illuminate\Http\Request;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Notice;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\ModelFilters\Basic\AidFilter;
use AvisoNavAPI\Http\Resources\Aid\AidResource;
use AvisoNavAPI\Aid;
use AvisoNavAPI\Traits\Responser;

class NoticeAidController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\Aid\AidResource
     */
    public function index(Notice $notice)
    {
        $noticeId = $notice->id;
        $collection = $notice->aid()->filter(request()->all(), AidFilter::class)
                                    ->with([
                                        'coordinate' => function($query) use ($noticeId){
                                            $query->join('notice_aid', function($query) use ($noticeId){
                                                $query->on('coordinate.aid_id', 'notice_aid.aid_id')
                                                        ->on('notice_aid.coordinate_id', 'coordinate.id')
                                                        ->where('notice_aid.notice_id', '=', $noticeId);
                                            });
                                        },
                                        'aidLang' => $this->withLanguageQuery(),
                                        'location.zone.zoneLang' => $this->withLanguageQuery(),
                                        'lightClass.lightClassLang' => $this->withLanguageQuery(),
                                        'colorStructurePattern.colorStructureLang' => $this->withLanguageQuery(),
                                        'topMark.topMarkLang' => $this->withLanguageQuery(),
                                        'aidType.aidTypeLang' => $this->withLanguageQuery(),
                                        'aidTypeForm.aidTypeFormLang' => $this->withLanguageQuery()
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
        $notice->aid()->attach($aid->id, ['coordinate_id' => $aid->coordinate->id]);
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
