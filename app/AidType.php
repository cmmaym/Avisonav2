<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use AvisoNavAPI\Traits\Observable;

class AidType extends Model
{
    use Filterable, Observable;

    protected $table        = 'aid_type';

    public function aidTypeLangs()
    {
        return $this->hasMany(AidTypeLang::class);
    }

    public function aidTypeLang()
    {
        return $this->hasOne(AidTypeLang::class);
    }

    public function aidTypeForm(){
        return $this->belongsToMany(AidTypeForm::class)
                    ->withTimestamps();
    }

}
