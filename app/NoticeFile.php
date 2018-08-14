<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class NoticeFile extends Model
{
    use Filterable;

    protected $table        = 'notice_file';
    protected $fillable     = ['name', 'path'];

    public function notice()
    {
        return $this->belongsTo(Notice::class);
    }
}
