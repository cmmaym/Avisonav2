<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class AidTypeForm extends Model
{
    use Filterable;

    protected $table        = 'aid_type_form';

    public function aidTypeFormLangs()
    {
        return $this->hasMany(AidTypeFormLang::class);
    }

    public function aidTypeFormLang()
    {
        return $this->hasOne(AidTypeFormLang::class);
    }

    public function aidType(){
        return $this->belongsToMany(AidType::class)
                    ->withTimestamps();
    }

}