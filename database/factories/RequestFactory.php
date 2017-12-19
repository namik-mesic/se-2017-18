<?php

use Faker\Generator as Faker;



$factory->define(App\Requests::class, function (Faker $faker) {

    return [
        'statusat' => $faker->numberBetween(0,3),
    ];
});