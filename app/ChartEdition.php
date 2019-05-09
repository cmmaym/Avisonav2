<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class ChartEdition extends Model
{
    use Filterable;

    protected $table        = 'chart_edition';
    protected $fillable     = ['edition', 'year'];
    protected $casts = [
        'is_legacy' => 'boolean',
    ];

    public function chart()
    {
        return $this->belongsTo(Chart::class);
    }
}
