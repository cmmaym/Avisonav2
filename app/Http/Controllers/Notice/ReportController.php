<?php

namespace AvisoNavAPI\Http\Controllers\Notice;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use Maatwebsite\Excel\Facades\Excel;
use AvisoNavAPI\Exports\NoticeNoveltyGTPExport;

class ReportController extends Controller
{

    /**
     * Genera el reporte de avisos, novedades (generales, temporares y permanentes) por año
     */
    public function noticeNoveltyGTP(Request $request)
    {
        return Excel::download(new NoticeNoveltyGTPExport, 'Avisos y novedades por mes.xlsx');
    }
}