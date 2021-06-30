<?php

namespace AvisoNavAPI\Http\Controllers\Notice;

use AvisoNavAPI\Notice;
use AvisoNavAPI\Novelty;
use AvisoNavAPI\Language;
use AvisoNavAPI\NoticeLang;
use AvisoNavAPI\Role;
use AvisoNavAPI\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use AvisoNavAPI\AvisoDetalle;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use AvisoNavAPI\ConsecutiveNotice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use AvisoNavAPI\Http\Resources\AyudaResource;
use AvisoNavAPI\ModelFilters\Basic\NoticeFilter;
use AvisoNavAPI\Http\Requests\Notice\StoreNotice;
use AvisoNavAPI\Http\Resources\Notice\NoticeResource;
use AvisoNavAPI\Http\Resources\Notice\NoticePublicResource;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AvisoNavAPI\ModelFilters\NoticeFilter as AvisoNavAPINoticeFilter;
use Illuminate\Support\Carbon;

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

            $language = Language::where('code','es')->firstOrFail();

            $notice = new Notice();
            $notice->number = $newConsec;
            $year = (new \DateTime("now"))->format('Y');
            $notice->reports_numbers = $request->input('reportsNumbers');
            $notice->report_date = $request->input('reportDate');
            $notice->year = $year;
            $notice->location_id = $request->input('location');
            $notice->report_source_id = $request->input('reportSource');
            $notice->reporting_user_id = $request->input('reportingUser');
            $notice->state = 'G';
            
            $notice->catalog_ocean_coast_id = ($request->input('catalogOceanCoast')) ? $request->input('catalogOceanCoast') : null;
            $notice->light_list_id = ($request->input('lightList')) ? $request->input('lightList') : null;
    
            $notice->save();

            $description = $request->input('description');

            if($description)
            {
                $noticeLang = new NoticeLang();
                $noticeLang->description = $description;
                $noticeLang->language_id = $language->id;
        
                $notice->noticeLang()->save($noticeLang);
            }    

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
        $notice->location_id = $request->input('location');
        $notice->report_source_id = $request->input('reportSource');
        $notice->reporting_user_id = $request->input('reportingUser');
        $notice->state = $request->input('state');

        $notice->catalog_ocean_coast_id = ($request->input('catalogOceanCoast')) ? $request->input('catalogOceanCoast') : null;
        $notice->light_list_id = ($request->input('lightList')) ? $request->input('lightList') : null;

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

    public function confirmNoticeRevision($noticeId){
        $notice = Notice::where('id', '=', $noticeId)
                        ->firstOrFail();

        $user = Auth::user();

        $rhUser = User::whereHas('role', function(Builder $query){
                           $query->where('name', 'like', '%ROLE_RH%');
                        })
                        ->where('state', 'A')
                        ->orderBy('created_at', 'desc')->first();
        if($rhUser){
            if($rhUser->sign_automatically){
                $notice->rh_user = $rhUser->username;
                $notice->rh_date_user_confirm = new \DateTime("now");
            }
        }

        $allowedRoles = ['ROLE_ADMIN', 'ROLE_REVISOR'];
        if(!in_array($user->role->name, $allowedRoles)){
            return $this->errorResponse('No tiene permisos para esta acción', 409);
        }
        
        $notice->review_user = $user->username;
        $notice->review_date = new \DateTime("now");

        $notice->save();

        return new NoticeResource($notice);
    }

    public function deleteNoticeRevision($noticeId){
        $notice = Notice::where('id', '=', $noticeId)
                        ->firstOrFail();

        $user = Auth::user();

        $allowedRoles = ['ROLE_ADMIN', 'ROLE_REVISOR'];

        if(!in_array($user->role->name, $allowedRoles)){
            return $this->errorResponse('No tiene permisos para realizar esta acción', 409);
        }

        if($notice->review_user !== $user->username){
            return $this->errorResponse('No tiene permisos para realizar esta acción', 409);
        }

        $notice->review_user = null;
        $notice->review_date = null;
        $notice->rh_user = null;
        $notice->rh_date_user_confirm = null;

        $notice->save();

        return new NoticeResource($notice);
    }

    public function confirmNoticeByRH($noticeId){
        $notice = Notice::where('id', '=', $noticeId)
            ->firstOrFail();

        $user = Auth::user();

        if($user->role->name != "ROLE_RH"){
            return $this->errorResponse('No tiene permisos para esta acción', 409);
        }

        $notice->rh_user = $user->username;
        $notice->rh_date_user_confirm = new \DateTime("now");

        $notice->save();

        return new NoticeResource($notice);
    }

    public function deleteConfirmNoticeByRH($noticeId){
        $notice = Notice::where('id', '=', $noticeId)
            ->firstOrFail();

        $user = Auth::user();

        if($user->role->name != "ROLE_RH"){
            return $this->errorResponse('No tiene permisos para esta acción', 409);
        }

        if($notice->rh_user !== $user->username){
            return $this->errorResponse('No tiene permisos para realizar esta acción', 409);
        }

        $notice->rh_user = null;
        $notice->rh_date_user_confirm = null;

        $notice->save();

        return new NoticeResource($notice);
    }

    public function getNotice($number, $year)
    {
        $notice = Notice::with([
            'noticeLang' => $this->withLanguageQuery(),
            'location.zone.zoneLang' => $this->withLanguageQuery(),
            'novelty.noveltyLang' => $this->withLanguageQuery(),
            'novelty.noveltyType.noveltyTypeLang' => $this->withLanguageQuery(),
            'novelty.characterType.characterTypeLang' => $this->withLanguageQuery(),
        ])
        ->where('number', '=', $number)
        ->where('year', '=', $year)
        ->where('state', '=', 'P')
        ->firstOrFail();

        $notice->novelty->each(function($item){
            if($item->symbol)
            {
                $sn = $item->symbol;
                $item->load([
                    'symbol.symbol.symbolLang' => $this->withLanguageQuery(),
                    'symbol.symbol.aid.colorStructurePattern.colorStructureLang' => $this->withLanguageQuery(),
                    'symbol.symbol.aid.aidTypeForm.aidTypeFormLang' => $this->withLanguageQuery(),
                    'symbol.symbol.aid.topMark.topMarkLang' => $this->withLanguageQuery(),
                    'symbol.symbol.aid.height' => function($query) use ($sn){
                        $query->where('id', $sn->height_id);
                    },
                    'symbol.symbol.aid.nominalScope' => function($query) use ($sn){
                        $query->where('id', $sn->nominal_scope_id);
                    },
                    'symbol.symbol.aid.period' => function($query) use ($sn){
                        $query->where('id', $sn->period_id);
                    }
                ]);
            }
        });

        return new NoticePublicResource($notice);
    }

    public function getAllNoticeYear() 
    {
        $collection = Notice::select('year')
                           ->groupBy('year')
                           ->orderBy('year', 'desc')
                           ->get();

        return response()->json($collection);
    }
    
    public function getAllNoticeNumberByYear($year) 
    {
        $collection = Notice::select('number', 'year')
                           ->groupBy('number')
                           ->where('year', '=', $year)
                           ->where('notice.state', '=', 'P')
                           ->get();

        return response()->json($collection);
    }

    public function getTotalNoticeNovelty()
    {
        $consecutiveNotice = ConsecutiveNotice::orderBy('year', 'desc')->firstOrFail();
        
        DB::statement("SET lc_time_names = 'es_CO';");

        $notice = DB::select("
                SELECT MONTHNAME(m.merge_date) as name, IFNULL(n.total, 0) as total
                FROM (
                    SELECT '2000-01-01' AS merge_date, 0 as total
                    UNION SELECT '2000-02-01' AS merge_date, 0 as total
                    UNION SELECT '2000-03-01' AS merge_date, 0 as total
                    UNION SELECT '2000-04-01' AS merge_date, 0 as total
                    UNION SELECT '2000-05-01' AS merge_date, 0 as total
                    UNION SELECT '2000-06-01' AS merge_date, 0 as total
                    UNION SELECT '2000-07-01' AS merge_date, 0 as total
                    UNION SELECT '2000-08-01' AS merge_date, 0 as total
                    UNION SELECT '2000-09-01' AS merge_date, 0 as total
                    UNION SELECT '2000-10-01' AS merge_date, 0 as total
                    UNION SELECT '2000-11-01' AS merge_date, 0 as total
                    UNION SELECT '2000-12-01' AS merge_date, 0 as total
                        
                ) as m
                left join (
                    SELECT MONTH(created_at) as month, count(id) as total
                    FROM notice
                    WHERE YEAR(created_at) = ?
                    GROUP BY MONTH(created_at)
                ) as n on n.month = MONTH(m.merge_date)
                ORDER BY m.merge_date ASC",
                [$consecutiveNotice->year]
            );
        
        $novelty = DB::select("
            SELECT MONTHNAME(m.merge_date) as name, IFNULL(n.total, 0) as total
            FROM (
                SELECT '2000-01-01' AS merge_date, 0 as total
                UNION SELECT '2000-02-01' AS merge_date, 0 as total
                UNION SELECT '2000-03-01' AS merge_date, 0 as total
                UNION SELECT '2000-04-01' AS merge_date, 0 as total
                UNION SELECT '2000-05-01' AS merge_date, 0 as total
                UNION SELECT '2000-06-01' AS merge_date, 0 as total
                UNION SELECT '2000-07-01' AS merge_date, 0 as total
                UNION SELECT '2000-08-01' AS merge_date, 0 as total
                UNION SELECT '2000-09-01' AS merge_date, 0 as total
                UNION SELECT '2000-10-01' AS merge_date, 0 as total
                UNION SELECT '2000-11-01' AS merge_date, 0 as total
                UNION SELECT '2000-12-01' AS merge_date, 0 as total
                    
            ) as m
            left join (
                SELECT MONTH(created_at) as month, count(id) as total
                FROM novelty
                WHERE YEAR(created_at) = ?
                GROUP BY MONTH(created_at)
            ) as n on n.month = MONTH(m.merge_date)
            ORDER BY m.merge_date ASC",
            [$consecutiveNotice->year]
        );

        $collection = collect(['notice' => collect($notice), 'novelty' => collect($novelty)]);
        
        $collection->map(function($item){
            $item->map(function($data){
                $data->name = ucfirst($data->name);
            });
        });

        return response()->json($collection);
    }

    public function getRecentNotice() 
    {
        $collection = Notice::with([
                        'noticeLang' => $this->withLanguageQuery(),
                        'location.zone.zoneLang' => $this->withLanguageQuery(),
                        'novelty.noveltyLang' => $this->withLanguageQuery(),
                        'novelty.noveltyType.noveltyTypeLang' => $this->withLanguageQuery(),
                        'novelty.characterType.characterTypeLang' => $this->withLanguageQuery(),
                    ])
                    ->where('state', '=', 'P')
                    ->orderBy('created_at', 'desc')
                    ->orderBy('notice.number', 'desc')
                    ->take(7)
                    ->get();
        
        $collection->each(function($notice){
            $notice->novelty->each(function($item){
                if($item->symbol)
                {
                    $sn = $item->symbol;
                    $item->load([
                        'symbol.symbol.symbolLang' => $this->withLanguageQuery(),
                        'symbol.symbol.aid.colorStructurePattern.colorStructureLang' => $this->withLanguageQuery(),
                        'symbol.symbol.aid.aidTypeForm.aidTypeFormLang' => $this->withLanguageQuery(),
                        'symbol.symbol.aid.topMark.topMarkLang' => $this->withLanguageQuery(),
                        'symbol.symbol.aid.height' => function($query) use ($sn){
                            $query->where('id', $sn->height_id);
                        },
                        'symbol.symbol.aid.nominalScope' => function($query) use ($sn){
                            $query->where('id', $sn->nominal_scope_id);
                        },
                        'symbol.symbol.aid.period' => function($query) use ($sn){
                            $query->where('id', $sn->period_id);
                        }
                    ]);
                }
            });
        });

        return NoticePublicResource::collection($collection);
    }

    public function getDateFromLastFourWeek(){

        $collection = DB::select(
                "select week(x.dateStart, 1) week,
                        x.dateStart,
                        x.dateEnd
                from (
                select 
                        date_format(adddate(created_at, INTERVAL(2-DAYOFWEEK(created_at)) DAY), '%Y-%m-%d') dateStart,
                        date_format(adddate(created_at, INTERVAL(8-DAYOFWEEK(created_at)) DAY), '%Y-%m-%d') dateEnd
                from avisonav.notice n, (select @max_created_at:=(select max(created_at) from avisonav.notice)) x
                where n.created_at >= date_sub(@max_created_at, interval 7 week) and n.created_at <= @max_created_at
                ) x
                group by week(x.dateStart, 1), x.dateStart, x.dateEnd
                order by week(x.dateStart, 1) desc;"
        );

        return response()->json($collection);
    }

    public function getNoticeByDate(Request $request){

        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');

        $collection = Notice::with([
            'noticeLang' => $this->withLanguageQuery(),
            'location.zone.zoneLang' => $this->withLanguageQuery(),
            'novelty.noveltyLang' => $this->withLanguageQuery(),
            'novelty.noveltyType.noveltyTypeLang' => $this->withLanguageQuery(),
            'novelty.characterType.characterTypeLang' => $this->withLanguageQuery(),
        ])
        ->where('state', '=', 'P')
        ->whereBetween('created_at', [$startDate, $endDate])
        ->orderBy('created_at', 'asc')
        ->get();

        $collection->each(function($notice){
            $notice->novelty->each(function($item){
                if($item->symbol)
                {
                    $sn = $item->symbol;
                    $item->load([
                        'symbol.symbol.symbolLang' => $this->withLanguageQuery(),
                        'symbol.symbol.aid.colorStructurePattern.colorStructureLang' => $this->withLanguageQuery(),
                        'symbol.symbol.aid.aidTypeForm.aidTypeFormLang' => $this->withLanguageQuery(),
                        'symbol.symbol.aid.topMark.topMarkLang' => $this->withLanguageQuery(),
                        'symbol.symbol.aid.height' => function($query) use ($sn){
                            $query->where('id', $sn->height_id);
                        },
                        'symbol.symbol.aid.nominalScope' => function($query) use ($sn){
                            $query->where('id', $sn->nominal_scope_id);
                        },
                        'symbol.symbol.aid.period' => function($query) use ($sn){
                            $query->where('id', $sn->period_id);
                        }
                    ]);
                }
            });
        });

        if($collection->isEmpty()){
            throw new NotFoundHttpException();
        }

        $data = [
            'startDate' => $startDate,
            'endDate'   => $endDate,
            'data'      => NoticePublicResource::collection($collection)
        ];

        return $data;
    }

    public function filterNotice(){
        $collection = Notice::filter(request()->all(), AvisoNavAPINoticeFilter::class)
                            ->with([
                                'noticeLang' => $this->withLanguageQuery(),
                                'location.zone.zoneLang' => $this->withLanguageQuery(),
                                'novelty.noveltyLang' => $this->withLanguageQuery(),
                                'novelty.noveltyType.noveltyTypeLang' => $this->withLanguageQuery(),
                                'novelty.characterType.characterTypeLang' => $this->withLanguageQuery()
                            ])
                            ->where('state', '=', 'P')
                            ->paginateFilter($this->perPage());

        $collection->each(function($notice){
            $notice->novelty->each(function($item){
                if($item->symbol)
                {
                    $sn = $item->symbol;
                    $item->load([
                        'symbol.symbol.symbolLang' => $this->withLanguageQuery(),
                        'symbol.symbol.aid.colorStructurePattern.colorStructureLang' => $this->withLanguageQuery(),
                        'symbol.symbol.aid.aidTypeForm.aidTypeFormLang' => $this->withLanguageQuery(),
                        'symbol.symbol.aid.topMark.topMarkLang' => $this->withLanguageQuery(),
                        'symbol.symbol.aid.height' => function($query) use ($sn){
                            $query->where('id', $sn->height_id);
                        },
                        'symbol.symbol.aid.nominalScope' => function($query) use ($sn){
                            $query->where('id', $sn->nominal_scope_id);
                        },
                        'symbol.symbol.aid.period' => function($query) use ($sn){
                            $query->where('id', $sn->period_id);
                        }
                    ]);
                }
            });
        });

        if($collection->isEmpty()){
            throw new NotFoundHttpException();
        }
        
        return NoticePublicResource::collection($collection);
    }

    public function getNoticeById($id)
    {
        $notice = Notice::with([
            'noticeLang' => $this->withLanguageQuery(),
            'location.zone.zoneLang' => $this->withLanguageQuery(),
            'novelty.noveltyLang' => $this->withLanguageQuery(),
            'novelty.noveltyType.noveltyTypeLang' => $this->withLanguageQuery(),
            'novelty.characterType.characterTypeLang' => $this->withLanguageQuery(),
        ])
        ->where('id', '=', $id)
        ->firstOrFail();

        $notice->novelty->each(function($item){
            if($item->symbol)
            {
                $sn = $item->symbol;
                $item->load([
                    'symbol.symbol.symbolLang' => $this->withLanguageQuery(),
                    'symbol.symbol.aid.colorStructurePattern.colorStructureLang' => $this->withLanguageQuery(),
                    'symbol.symbol.aid.aidTypeForm.aidTypeFormLang' => $this->withLanguageQuery(),
                    'symbol.symbol.aid.topMark.topMarkLang' => $this->withLanguageQuery(),
                    'symbol.symbol.aid.height' => function($query) use ($sn){
                        $query->where('id', $sn->height_id);
                    },
                    'symbol.symbol.aid.nominalScope' => function($query) use ($sn){
                        $query->where('id', $sn->nominal_scope_id);
                    },
                    'symbol.symbol.aid.period' => function($query) use ($sn){
                        $query->where('id', $sn->period_id);
                    }
                ]);
            }
        });

        return new NoticePublicResource($notice);
    }
}
