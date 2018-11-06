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

    public function name($name)
    {
        return $this->where(function($query) use ($name){
            $query->where('name1', 'like', "%$name%")
                  ->orWhere('name2', 'like', "%$name%");
        });
    }
    
    public function lastName($lastName)
    {
        return $this->where(function($query) use ($lastName){
            $query->where('last_name1', 'like', "%$lastName%")
                  ->orWhere('last_name2', 'like', "%$lastName%");
        });
    }

    public function email($email)
    {
        return $this->where('email', 'like', "%$email%");
    }

    public function createdAt($createdAt){
        return $this->whereRaw("(STR_TO_DATE(created_at, '%Y-%m-%d') between ? and ?)", array($createdAt, $createdAt));
    }

    public function createdBy($createdBy){
        return $this->where('user.created_by', 'like', "%$createdBy%");
    }
    
    public function state($state){
        return $this->where('state', '=', $state);
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
    
    public function sortByName()
    {
        return $this->orderBy('name1', $this->input('dir', 'asc'));
    }
    
    public function sortByLastName()
    {
        return $this->orderBy('last_name1', $this->input('dir', 'asc'));
    }

    public function sortByEmail()
    {
        return $this->orderBy('email', $this->input('dir', 'asc'));
    }

    public function sortByCreatedAt()
    {
        return $this->orderBy('created_at', $this->input('dir', 'asc'));
    }
}