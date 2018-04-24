<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class ZoneLangFilter extends ModelFilter
{
    public function zone($name)
    {
        return $this->where('name', 'like', "%$name%");
    }

    public function alias($alias)
    {
        return $this->where('alias', 'like', "%$alias%");
    }

    public function language($language)
    {
        return $this->where('language_id', '=', $language);
    }

    public function sort($column)
    {
        if(method_exists($this, $method = 'sortBy' . studly_case($column))) {
            return $this->$method();
        }

        return $this->orderBy('zone_id', $this->input('dir', 'asc'));
    }

    public function sortByZone()
    {
        return $this->orderBy('name', $this->input('dir', 'asc'));
    }

    public function sortByAlias()
    {
        return $this->orderBy('alias', $this->input('dir', 'asc'));
    }

    public function sortByDate()
    {
        return $this->orderBy('created_at', $this->input('dir', 'asc'));
    }
}