<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;
use AvisoNavAPI\Traits\Observable;

class ChartPurposeLang extends Model
{
    use Filterable, Observable;

    protected $table        = 'chart_purpose_lang';

    public function chartPurpose(){
        return $this->belongsTo(ChartPurpose::class);
    }

    public function language(){
        return $this->belongsTo(Language::class);
    }

}
