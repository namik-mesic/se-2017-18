<?php

use Faker\Generator as Faker;


$factory->define(App\advertisements::class, function (Faker $faker) {


    return [
        'titles' => $faker->name(),
        'description' => $faker->realText(50),
        'image'=>$faker->realText(1000),
        'url' => $faker->realText(15)

    ];
});