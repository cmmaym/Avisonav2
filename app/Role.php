<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use Filterable;

    protected $table        = 'role';
    protected $fillable     = ['name'];

    public function permission()
    {
        return $this->belongsToMany(Permission::class, 'role_permission')->withTimestamps();
    }

}
