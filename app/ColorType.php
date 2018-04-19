<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class ColorType extends Model
{
    use Filterable;
    
    protected $table        = 'color_type';
    protected $fillable     = ['color', 'alias', 'state'];

    public function language(){
        return $this->belongsto(Language::class);
    }

    public function colorType(){
        return $this->hasMany(ColorType::class, 'parent_id', 'id');
    }

    public function parent(){
        return $this->belongsTo(ColorType::class);
    }
}