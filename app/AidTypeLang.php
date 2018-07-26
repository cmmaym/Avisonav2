<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class AidTypeLang extends Model
{
    use Filterable;

    protected $table        = 'aid_type_lang';
    protected $fillable     = ['name'];

    public function language(){
        return $this->belongsTo(Language::class);
    }

    public function aidType()
    {
        return $this->belongsTo(AidType::class);
    }

}
