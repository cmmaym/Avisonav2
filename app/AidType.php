<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class AidType extends Model
{
    use Filterable;

    protected $table        = 'aid_type';
    protected $fillable     = ['type', 'state'];

    public function aidTypeLangs()
    {
        return $this->hasMany(AidTypeLang::class);
    }

    public function aidTypeLang()
    {
        return $this->hasOne(AidTypeLang::class);
    }

}
