<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class AidTypeFormLang extends Model
{
    use Filterable;

    protected $table        = 'aid_type_form_lang';
    protected $fillable     = ['description'];

    public function language(){
        return $this->belongsTo(Language::class);
    }

    public function aidTypeForm()
    {
        return $this->belongsTo(AidTypeForm::class);
    }

}
