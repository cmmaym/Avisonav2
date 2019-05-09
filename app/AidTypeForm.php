<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use AvisoNavAPI\Traits\Observable;

class AidTypeForm extends Model
{
    use Filterable, Observable;

    protected $table        = 'aid_type_form';
    protected $casts = [
        'is_legacy' => 'boolean',
    ];

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
