<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class ImageFilter extends ModelFilter
{
    public function name($name)
    {
        return $this->where('name', 'like', "%$name%");
    }

    public function sort($column)
    {
        if(method_exists($this, $method = 'sortBy' . studly_case($column))) {
            return $this->$method();
        }

        return $this->orderBy('id', $this->input('dir', 'desc'));
    }

    public function sortByName()
    {
        return $this->orderBy('name', $this->input('dir', 'asc'));
    }
}