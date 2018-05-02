<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class AidTypeFilter extends ModelFilter
{

    public function type($type){
        return $this->where('type', 'like', "%$type%");
    }

    public function name($name){
        return $this->related('aidTypeLang', 'name', 'like', "%$name%");
    }

    public function date($date){
        return $this->whereRaw("(STR_TO_DATE(created_at, '%Y-%m-%d') between ? and ?)", array($date, $date));
    }

    public function language($language){
        return $this->related('aidTypeLang', 'aid_type_lang.language_id', '=', $language);
    }

    public function sort($column)
    {
        if(method_exists($this, $method = 'sortBy' . studly_case($column))) {
            return $this->$method();
        }

        return $this->orderBy('id', $this->input('dir', 'asc'));
    }

    public function sortByType()
    {
        return $this->orderBy('type', $this->input('dir', 'asc'));
    }

    public function sortByName(){
        $input = $this->input('dir', 'asc');

        $this->join('aid_type_lang', 'aid_type_lang.aid_type_id', '=', 'aid_type.id')
             ->orderBy('aid_type_lang.name', $input)
             ->select('aid_type.*');
    }

    public function sortByDate()
    {
        return $this->orderBy('created_at', $this->input('dir', 'asc'));
    }
}