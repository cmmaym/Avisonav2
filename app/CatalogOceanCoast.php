<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class CatalogOceanCoast extends Model
{
    use Filterable;

    protected $table        = 'catalog_ocean_coast';
    protected $fillable     = ['edition', 'year'];
}