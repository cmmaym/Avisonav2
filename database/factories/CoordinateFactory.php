<?php

use Faker\Generator as Faker;

$factory->define(AvisoNavAPI\Coordinate::class, function (Faker $faker) {
    return [
        'latitud'   =>  $faker->latitude(),
        'longitud'  =>  $faker->longitude(),
        'elevation' =>  $faker->randomDigit,
        'scope'     =>  $faker->randomDigit,
        'quantity'  =>  $faker->randomDigit
    ];
});
