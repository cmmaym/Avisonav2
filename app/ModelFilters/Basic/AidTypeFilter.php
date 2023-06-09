<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class AidTypeFilter extends ModelFilter
{
    public function name($name){
        return $this->whereHas('aidTypeLang', function($query) use ($name){
                    $query->where('aid_type_lang.name', 'like', "%$name%")
                        ->where('language.code', '=', 'es')
                        ->join('language', 'language.id', '=', 'aid_type_lang.language_id');
        });
    }

    public function createdAt($createdAt){
        return $this->whereRaw("(STR_TO_DATE(created_at, '%Y-%m-%d') between ? and ?)", array($createdAt, $createdAt));
    }

    public function createdBy($createdBy){
        return $this->where('aid_type.created_by', 'like', "%$createdBy%");
    }

    public function sort($column)
    {
        if(method_exists($this, $method = 'sortBy' . studly_case($column))) {
            return $this->$method();
        }

        return $this->orderBy('id', $this->input('dir', 'asc'));
    }

    public function sortByName(){
        $input = $this->input('dir', 'asc');

        $this->join('aid_type_lang', 'aid_type_lang.aid_type_id', '=', 'aid_type.id')
              ->groupBy('aid_type.id')
             ->orderBy('aid_type_lang.name', $input)
             ->select('aid_type.*');
    }

    public function sortByCreatedAt()
    {
        return $this->orderBy('created_at', $this->input('dir', 'asc'));
    }

    public function sortByAidType()
    {
        return $this->orderBy('is_legacy', $this->input('dir', 'asc'));
    }
}