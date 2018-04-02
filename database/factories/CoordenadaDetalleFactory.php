<?php

use Faker\Generator as Faker;

$factory->define(AvisoNavAPI\CoordenadaDetalle::class, function (Faker $faker) {
    return [
        'descripcion'   =>  $faker->paragraph,
        'observacion'   =>  $faker->paragraph,
        'coordenada_id' =>  1,
        'tipo_luz_id'   =>  1,
        'tipo_color_id' =>  1,
        'idioma_id'     =>  1
    ];
});
