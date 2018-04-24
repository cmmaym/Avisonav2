<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class ColorTypeLang extends Model
{
    use Filterable;

    protected $table        = 'color_type_lang';
    protected $fillable     = ['color', 'alias'];

    public function language(){
        return $this->belongsto(Language::class);
    }

    public function colorType(){
        return $this->belongsTo(ColorType::class);
    }

}
