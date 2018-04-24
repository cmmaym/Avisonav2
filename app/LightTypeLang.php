<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class LightTypeLang extends Model
{
    use Filterable;

    protected $table        = 'light_type_lang';
    protected $fillable     = ['class', 'alias', 'description'];

    public function language(){
        return $this->belongsTo(Language::class);
    }

    public function lightType(){
        return $this->belongsTo(LightType::class);
    }

}
