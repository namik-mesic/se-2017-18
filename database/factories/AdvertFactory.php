<?php

use Faker\Generator as Faker;


$factory->define(App\Advert::class, function (Faker $faker) {


    return [
        'titles' => $faker->name(),
        'texts' => $faker->realText(50),
        //'picture' => $faker->picture,
        'activefrom' => $faker->time(),
        'activeto' => $faker->time(),
    ];
});