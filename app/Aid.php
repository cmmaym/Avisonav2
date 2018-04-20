<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class Aid extends Model
{
    use Filterable;
    
    protected $table        = 'aid';
    protected $fillable     = [
        'number',
        'sub_name',
        'state'
    ];

    public function location(){
        return $this->belongsTo(Location::class);
    }

    public function AidDetail(){
        return $this->hasMany(AidDetail::class);
    }

    
    // public function aviso(){
    //     return $this->belongsToMany(Aviso::class);
    // }
    
    // public function coordenada(){
    //     return $this->hasOne(Coordenada::class)
    //                 ->join('aviso_ayuda', function($query){
    //                     $query->on('coordenada.ayuda_id', 'aviso_ayuda.ayuda_id')
    //                           ->on('aviso_ayuda.coordenada_id', 'coordenada.id');
    //                 });
    // }
}
