<?php

namespace AvisoNavAPI\ModelFilters;

use EloquentFilter\ModelFilter;

class NoticeNoveltyFilter extends ModelFilter
{
    public function startDate($startDate){
        return $this->whereRaw("(STR_TO_DATE(created_at, '%Y-%m-%d') >= ?)", array($startDate));
    }

    public function endDate($endDate){
        return $this->whereRaw("(STR_TO_DATE(created_at, '%Y-%m-%d') <= ?)", array($endDate));
    }
}