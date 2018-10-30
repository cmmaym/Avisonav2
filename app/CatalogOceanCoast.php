<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use AvisoNavAPI\Traits\Observable;

class CatalogOceanCoast extends Model
{
    use Filterable, Observable;

    protected $table        = 'catalog_ocean_coast';
    protected $fillable     = ['edition', 'year'];
}