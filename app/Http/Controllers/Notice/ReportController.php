<?php

namespace AvisoNavAPI\Http\Controllers\Notice;

use AvisoNavAPI\Notice;
use AvisoNavAPI\Novelty;
use Illuminate\Http\Request;
use AvisoNavAPI\ReportParameter;
use AvisoNavAPI\Traits\Responser;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use AvisoNavAPI\Exports\NoticeNoveltyGTPExport;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;

class ReportController extends Controller
{
    use Responser;

    /**
     * Genera el reporte de avisos, novedades (generales, temporares y permanentes) por año
     */
    public function noticeNoveltyGTP(Request $request)
    {
        $year = $request->input('year');

        return Excel::download(new NoticeNoveltyGTPExport($year), 'Avisos y novedades por mes.xlsx');
    }

    public function noticePDF(Request $request){

        $number = $request->input('number');
        $year = $request->input('year');
        $sourceReviewAidList = filter_var($request->input('sourceReviewAidList'), FILTER_VALIDATE_BOOLEAN);
        $sourceReviewChart = filter_var($request->input('sourceReviewChart'), FILTER_VALIDATE_BOOLEAN);
        $charts = $request->input('charts') ?? [];
        $hasWebChecking = $request->input('hasWebChecking') ?? 'Y';
        $sentTo =  $request->input('sentTo') ?? null;
        $observation = $request->input('observation') ?? null;
      
        $dateEmailSent = (new \DateTime($request->input('dateEmailSent'))) ?? null;

        $notice = Notice::with([
            'location.zone.zoneLang' => $this->addLanguageQuery('es'),
            'reportSource',
            'user',
            'reviewUser'
        ])
        ->where('notice.number', '=', $number)
        ->where('notice.year', '=', $year)
        ->firstOrFail();

        //Validar que el aviso haya sido revisado
        if(!$notice->review_user){
            return $this->errorResponse('El aviso no ha sido revisado', 409);
        }

        $noticeLangs['es'] = $notice->noticeLangs()->whereHas('language', function($query){ $query->where('code', '=', 'es'); })->first();
        $noticeLangs['en'] = $notice->noticeLangs()->whereHas('language', function($query){ $query->where('code', '=', 'en'); })->first();

        $notice->noticeLangs = $noticeLangs;

        $notice['novelty_es'] = $this->loadNoveltyDataByLanguage($notice->id, 'es');

        $notice['novelty_en'] = $this->loadNoveltyDataByLanguage($notice->id, 'en');

        $noveltys = collect($notice['novelty_es']);

        $notice['chart'] = $noveltys->reduce(function($data, $item){ return $data->push($item->chartEdition); }, collect([]))
                                    ->flatten()
                                    ->reduce(function($data, $chartEdition){

                                        $inCollection = $data->contains(function($chart) use ($chartEdition){ 
                                            return $chart->id == $chartEdition->chart->id;
                                        });

                                        return !$inCollection ? $data->push($chartEdition->chart) : $data; 
                                    }, collect([]));

        $notice->sourceReviewAidList = $sourceReviewAidList;
        $notice->sourceReviewChart = $sourceReviewChart;
        $notice->charts = $charts;
        $notice->hasWebChecking = $hasWebChecking;
        $notice->dateEmailSent = $dateEmailSent;
        $notice->sentTo = $sentTo;
        $notice->observation = $observation;

        $firmas = ReportParameter::firstOrFail();

        $pdf = PDF::loadView('notice-pdf', ['notice' => $notice, 'firmas' => $firmas]);

        return $pdf->inline();
    //    return $pdf->download('chart.pdf');
    //    return view('notice-pdf');
    }

    private function loadNoveltyDataByLanguage($noticeId, $lang){
        $data = Novelty::with([
                    'noveltyLang' => $this->addLanguageQuery($lang),
                    'noveltyType.noveltyTypeLang' => $this->addLanguageQuery($lang),
                    'characterType.characterTypeLang' => $this->addLanguageQuery($lang),
                ])
                ->where('notice_id', '=', $noticeId)
                ->get();

        $data->map(function($item) use ($lang){
            if($item->symbol)
            {
                $sn = $item->symbol;
                $item->load([
                    'symbol.symbol.symbolLang' => $this->addLanguageQuery($lang),
                    'symbol.symbol.aid.colorStructurePattern.colorStructureLang' => $this->addLanguageQuery($lang),
                    'symbol.symbol.aid.aidTypeForm.aidTypeFormLang' => $this->addLanguageQuery($lang),
                    'symbol.symbol.aid.aidColorLight',
                    'symbol.symbol.aid.topMark.topMarkLang' => $this->addLanguageQuery($lang),
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

        return $data;
    }

    private function addLanguageQuery($language){
        return function($query) use ($language){
                return $query->whereHas('language', function($query) use ($language){
                    $query->where('code', '=', $language);
                });
        };
    }
}