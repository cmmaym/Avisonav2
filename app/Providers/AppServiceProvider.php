<?php

namespace AvisoNavAPI\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Validator::extend('idioma_duplicate', function ($attribute, $value, $parameters, $validator) {
            $idioma = [];
            foreach($value as $item){
                if(!in_array($item['idioma_id'], $idioma)){
                    $idioma[] = $item['idioma_id'];
                }else{
                    return false;
                }
            }

            return true;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
