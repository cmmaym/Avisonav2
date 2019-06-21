<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class AidTypeFormFilter extends ModelFilter
{
    public function description($description){
        return $this->whereHas('aidTypeFormLang', function($query) use ($description){
                    $query->where('description', 'like', "%$description%")
                          ->where('language.code', '=', 'es')
                          ->join('language', 'language.id', '=', 'aid_type_form_lang.language_id');
                });
    }

    public function createdAt($createdAt){
        return $this->whereRaw("(STR_TO_DATE(created_at, '%Y-%m-%d') between ? and ?)", array($createdAt, $createdAt));
    }

    public function createdBy($createdBy){
        return $this->where('aid_type_form.created_by', 'like', "%$createdBy%");
    }

    public function sort($column)
    {
        if(method_exists($this, $method = 'sortBy' . studly_case($column))) {
            return $this->$method();
        }

        return $this->orderBy('id', $this->input('dir', 'asc'));
    }

    public function sortByDescription(){
        $input = $this->input('dir', 'asc');

        $this->join('aid_type_form_lang', 'aid_type_form_lang.aid_type_form_id', '=', 'aid_type_form.id')
             ->groupBy('aid_type_form.id')
             ->orderBy('aid_type_form_lang.description', $input)
             ->select('aid_type_form.*');
    }

    public function sortByCreatedAt()
    {
        return $this->orderBy('created_at', $this->input('dir', 'asc'));
    }

    public function sortByIsLegacy()
    {
        return $this->orderBy('is_legacy', $this->input('dir', 'asc'));
    }
}