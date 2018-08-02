<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class ColorStructureLang extends Model
{
    use Filterable;

    protected $table        = 'color_structure_lang';
    protected $fillable     = ['name'];

    public function language(){
        return $this->belongsto(Language::class);
    }

    public function colorStructure(){
        return $this->belongsTo(ColorStructure::class);
    }

}
