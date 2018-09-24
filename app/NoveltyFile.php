<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use AvisoNavAPI\Traits\Observable;

class NoveltyFile extends Model
{
    use Filterable, Observable;

    protected $table        = 'novelty_file';
    protected $fillable     = ['name', 'path'];

    public function novelty()
    {
        return $this->belongsTo(Novelty::class);
    }
}
