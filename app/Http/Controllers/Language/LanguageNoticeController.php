<?php

namespace AvisoNavAPI\Http\Controllers\Language;

use AvisoNavAPI\Notice;
use AvisoNavAPI\Language;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Responser;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Http\Resources\NoticeResource;

class LanguageNoticeController extends Controller
{
    use Responser;
    
    /**
     * Display the specified resource.
     *
     * @param Language $language
     * @param Notice $notice
     * @return \Illuminate\Http\Response
     */
    public function show(Language $language, Notice $notice)
    {
        $notice->load([
                'entity',
                'noticeDetail' => function($query) use ($language){
                    $query->where('language_id', $language->id);
                }
        ]);

        return new NoticeResource($notice);
        
    }
}
