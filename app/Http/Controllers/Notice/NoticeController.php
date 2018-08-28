<?php

namespace AvisoNavAPI\Http\Controllers\Notice;

use AvisoNavAPI\Notice;
use AvisoNavAPI\NoticeLang;
use Illuminate\Http\Request;
use AvisoNavAPI\AvisoDetalle;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use AvisoNavAPI\Http\Resources\AyudaResource;
use AvisoNavAPI\ModelFilters\Basic\NoticeFilter;
use AvisoNavAPI\Http\Requests\Notice\StoreNotice;
use AvisoNavAPI\Http\Resources\Notice\NoticeResource;
use AvisoNavAPI\Http\Resources\Notice\NoticePublicResource;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\ConsecutiveNotice;

class NoticeController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Notice::filter(request()->all(), NoticeFilter::class)
                            ->with([
                                'noticeLang' => $this->withLanguageQuery(),
                                'location.zone.zoneLang' => $this->withLanguageQuery(),
                                'catalogOceanCoast',
                                'lightList',
                                'reportSource',
                                'reportingUser'
                            ])
                            ->paginateFilter($this->perPage());

        return NoticeResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Notice\StoreNotice  $request
     * @return \AvisoNavAPI\Http\Resources\NoticeResource
     */
    public function store(StoreNotice $request)
    {
        $notice = DB::transaction(function () use ($request){
            $consecutiveNotice = ConsecutiveNotice::orderBy('year', 'desc')->firstOrFail();
            
            $newConsec = str_pad($consecutiveNotice->number + 1, 3, '00', STR_PAD_LEFT);

            $notice = new Notice();
            $notice->number = $newConsec;
            $year = (new \DateTime("now"))->format('Y');
            $notice->reports_numbers = $request->input('reportsNumbers');
            $notice->report_date = $request->input('reportDate');
            $notice->year = $year;
            $notice->user = Auth::user()->username;
            $notice->location_id = $request->input('location');
            $notice->report_source_id = $request->input('reportSource');
            $notice->reporting_user_id = $request->input('reportingUser');
            $notice->state = 'G';
            
            $notice->catalog_ocean_coast_id = ($request->input('catalogOceanCoast')) ? $request->input('catalogOceanCoast') : null;
            $notice->light_list_id = ($request->input('lightList')) ? $request->input('lightList') : null;
    
            $notice->save();
    
            // $noticeLang = new NoticeLang();
            // $noticeLang->description = $request->input('description');
            // $noticeLang->language_id = $request->input('language');
    
            // $notice->noticeLang()->save($noticeLang);

            $consecutiveNotice->number = $newConsec;
            $consecutiveNotice->save();

            return $notice;
        });


        return new NoticeResource($notice);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\Notice  $notice
     * @return \AvisoNavAPI\Http\Resources\NoticeResource
     */
    public function show(Notice $notice)
    {
        $notice->load([
            'noticeLang' => $this->withLanguageQuery(),
            'location.zone.zoneLang' => $this->withLanguageQuery(),
            'catalogOceanCoast',
            'lightList',
            'reportSource',
            'reportingUser'
        ]);

        return new NoticeResource($notice);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Notice\StoreNotice  $request
     * @param  \AvisoNavAPI\Notice  $notice
     * @return \AvisoNavAPI\Http\Resources\NoticeResource
     */
    public function update(StoreNotice $request, Notice $notice)
    {
        $notice->fill($request->only(['state']));
        $notice->reports_numbers = $request->input('reportsNumbers');
        $notice->report_date = $request->input('reportDate');
        $notice->user = Auth::user()->username;
        $notice->location_id = $request->input('location');
        $notice->report_source_id = $request->input('reportSource');
        $notice->reporting_user_id = $request->input('reportingUser');
        $notice->state = $request->input('state');

        $notice->catalog_ocean_coast_id = ($request->input('catalogOceanCoast')) ? $request->input('catalogOceanCoast') : null;
        $notice->light_list_id = ($request->input('lightList')) ? $request->input('lightList') : null;

        $notice->parent_id = ($request->has('parent_id')) ? $request->input('parent_id') : null;

        if($notice->isClean()){
            return $this->errorResponse('Debe especificar por lo menos un valor diferente para actualizar', 409);
        }
        
        $notice->save();

        return new NoticeResource($notice);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\Notice  $notice
     * @return \AvisoNavAPI\Http\Resources\NoticeResource
     */
    public function destroy(Notice $notice)
    {
        $notice->delete();

        return new NoticeResource($notice);
    }

    public function getNotice($number)
    {
        $notice = Notice::with([
            'noticeLang' => $this->withLanguageQuery(),
            'location.zone.zoneLang' => $this->withLanguageQuery(),
            'catalogOceanCoast',
            'lightList',
            'reportSource',
            'reportingUser',
            'aid.symbol.coordinate',
            'aid.symbol.symbolLang' => $this->withLanguageQuery(),
            'aid.location.zone.zoneLang' => $this->withLanguageQuery(),
            'aid.lightClass.lightClassLang' => $this->withLanguageQuery(),
            'aid.colorStructurePattern.colorStructureLang' => $this->withLanguageQuery(),
            'aid.topMark.topMarkLang' => $this->withLanguageQuery(),
            'aid.aidType.aidTypeLang' => $this->withLanguageQuery(),
            'aid.aidTypeForm.aidTypeFormLang' => $this->withLanguageQuery(),
            'aid.aidColorStructure.colorStructureLang' => $this->withLanguageQuery(),
            'aid.aidColorLight.colorLightLang' => $this->withLanguageQuery(),
            'chartEdition.chart'
        ])
        ->where('number', '=', $number)
        ->where('state', '=', 'P')
        ->firstOrFail();

        return new NoticePublicResource($notice);
    }

    public function getAllNoticeYear() 
    {
        $collection = Notice::select('year')
                           ->groupBy('year')
                           ->get();

        return response()->json($collection);
    }
    
    public function getAllNoticeNumberByYear($year) 
    {
        $collection = Notice::select('number')
                           ->groupBy('number')
                           ->where('year', '=', $year)
                           ->get();

        return response()->json($collection);
    }

    public function getRecentNotice() 
    {
        $collection = Notice::with([
                        'noticeLang' => $this->withLanguageQuery(),
                        'location.zone.zoneLang' => $this->withLanguageQuery(),
                        'catalogOceanCoast',
                        'lightList',
                        'reportSource',
                        'reportingUser',
                        'aid.symbol.coordinate',
                        'aid.symbol.symbolLang' => $this->withLanguageQuery(),
                        'aid.location.zone.zoneLang' => $this->withLanguageQuery(),
                        'aid.lightClass.lightClassLang' => $this->withLanguageQuery(),
                        'aid.colorStructurePattern.colorStructureLang' => $this->withLanguageQuery(),
                        'aid.topMark.topMarkLang' => $this->withLanguageQuery(),
                        'aid.aidType.aidTypeLang' => $this->withLanguageQuery(),
                        'aid.aidTypeForm.aidTypeFormLang' => $this->withLanguageQuery(),
                        'aid.aidColorStructure.colorStructureLang' => $this->withLanguageQuery(),
                        'aid.aidColorLight.colorLightLang' => $this->withLanguageQuery(),
                        'chartEdition.chart'
                    ])
                    ->where('state', '=', 'P')
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();

        return NoticePublicResource::collection($collection);
    }
}
