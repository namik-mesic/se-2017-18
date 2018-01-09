<?php

use Faker\Generator as Faker;


$factory->define(App\advertisements::class, function (Faker $faker) {


    return [
        'titles' => $faker->name(),
        'texts' => $faker->realText(50),


    ];
});