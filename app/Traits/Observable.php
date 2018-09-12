<?php

namespace AvisoNavAPI\Traits;

use AvisoNavAPI\Observers\RecordConnectedUserObserver;

trait Observable {

    public static function boot()
    {
        $class = get_called_class();
        $class::observe(new RecordConnectedUserObserver());
    
        parent::boot();
    }
	
}