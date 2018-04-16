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
        Validator::extend('language_duplicate', function ($attribute, $value, $parameters, $validator) {
            $language = [];
            foreach($value as $item){
                if(!in_array($item['language_id'], $language)){
                    $language[] = $item['language_id'];
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
