<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;
use AvisoNavAPI\Traits\Observable;

class ColorStructureLang extends Model
{
    use Filterable, Observable;

    protected $table        = 'color_structure_lang';
    protected $fillable     = ['name'];

    public function language(){
        return $this->belongsto(Language::class);
    }

    public function colorStructure(){
        return $this->belongsTo(ColorStructure::class);
    }

}
