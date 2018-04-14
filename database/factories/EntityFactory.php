<?php

use Faker\Generator as Faker;

$factory->define(AvisoNavAPI\Entity::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'alias'  => $faker->unique()->userName,
    ];
});
