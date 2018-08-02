<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class AidType extends Model
{
    use Filterable;

    protected $table        = 'aid_type';
    protected $fillable     = ['type'];

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
