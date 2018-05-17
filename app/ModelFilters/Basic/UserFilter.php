<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class UserFilter extends ModelFilter
{
    public function numIde($numIde)
    {
        return $this->where('num_ide', 'like', "%$numIde%");
    }

    public function userName($userName)
    {
        return $this->where('username', 'like', "%$userName%");
    }

    public function name1($name1)
    {
        return $this->where('name1', 'like', "%$name1%");
    }
    
    public function name2($name2)
    {
        return $this->where('name2', 'like', "%$name2%");
    }
    
    public function lastName1($lastName1)
    {
        return $this->where('last_name1', 'like', "%$lastName1%");
    }
    
    public function lastName2($lastName2)
    {
        return $this->where('last_name2', 'like', "%$lastName2%");
    }

    public function email($email)
    {
        return $this->where('email', 'like', "%$email%");
    }

    public function date($date){
        return $this->whereRaw("(STR_TO_DATE(created_at, '%Y-%m-%d') between ? and ?)", array($date, $date));
    }

    public function sort($column)
    {
        if(method_exists($this, $method = 'sortBy' . studly_case($column))) {
            return $this->$method();
        }

        return $this->orderBy('id', $this->input('dir', 'asc'));
    }

    public function sortByNumIde()
    {
        return $this->orderBy('num_ide', $this->input('dir', 'asc'));
    }
    
    public function sortByUserName()
    {
        return $this->orderBy('username', $this->input('dir', 'asc'));
    }
    
    public function sortByName1()
    {
        return $this->orderBy('name1', $this->input('dir', 'asc'));
    }
    
    public function sortByName2()
    {
        return $this->orderBy('name2', $this->input('dir', 'asc'));
    }
    
    public function sortByLastName1()
    {
        return $this->orderBy('last_name1', $this->input('dir', 'asc'));
    }
    
    public function sortByLastName2()
    {
        return $this->orderBy('last_name2', $this->input('dir', 'asc'));
    }
    
    public function sortByEmail()
    {
        return $this->orderBy('email', $this->input('dir', 'asc'));
    }

    public function sortByDate()
    {
        return $this->orderBy('created_at', $this->input('dir', 'asc'));
    }
}