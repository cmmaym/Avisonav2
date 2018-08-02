<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class ColorStructure extends Model
{
    use Filterable;
    
    protected $table        = 'color_structure';

    public function colorStructureLangs()
    {
        return $this->hasMany(ColorStructureLang::class);
    }
    
    public function colorStructureLang()
    {
        return $this->hasOne(ColorStructureLang::class);
    }

}