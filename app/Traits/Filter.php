<?php

namespace AvisoNavAPI\Traits;

trait Filter {

    private function perPage(){
        $perPage = (int)request()->input('perPage') ?? 15;

        return $perPage;
    }
	
}