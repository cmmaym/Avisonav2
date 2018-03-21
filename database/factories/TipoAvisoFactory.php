<?php

use Faker\Generator as Faker;
use AvisoNavAPI\Idioma;

$factory->define(AvisoNavAPI\TipoAviso::class, function (Faker $faker) {

    $idioma = Idioma::all()->first();

    return [
        'nombre'    =>  $faker->name,        
        'idioma_id' =>  $idioma->id,
    ];
});
