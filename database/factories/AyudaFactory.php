<?php

use Faker\Generator as Faker;

$factory->define(AvisoNavAPI\Ayuda::class, function (Faker $faker) {
    return [
        'numero'        => $faker->numberBetween($min = 1, $max = 6),
        'nombre'        => $faker->word,
        'latitud'       => $faker->latitude,
        'longitud'      => $faker->longitude,
        'cantidad'      => 1,
        'altitud'       => $faker->randomDigit,
        'alcance'       => $faker->randomDigit,
        'descripcion'   => $faker->sentence,
        'observacion'   => $faker->sentence,        
        'version'       => 1,
        'user_id'    => 1,
        'aviso_id'      => 1,
        'ubicacion_id'   => 1,
        'tipo_luz_id'   => 1,
        'tipo_color_id' => 1,
        'idioma_id'     => 1,
    ];
});
