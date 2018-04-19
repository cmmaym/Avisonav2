<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class LightType extends Model
{
    use Filterable;

    protected $table        = 'light_type';
    protected $fillable     = ['class', 'alias', 'description', 'illustration', 'state'];

    public function language(){
        return $this->belongsTo(Language::class);
    }

    public function lightType(){
        return $this->hasMany(LightType::class, 'parent_id', 'id');
    }

    public function parent(){
        return $this->belongsTo(LightType::class);
    }
}
