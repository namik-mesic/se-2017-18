<?php

use Faker\Generator as Faker;



$factory->define(App\Friend::class, function (Faker $faker) {
    static $var = 1;
    return [
        'user_id' => $faker->numberBetween(1, 5),
        'friend_id' => $var++,
        'status' => $faker->randomElement(['yes', 'no']),
    ];
});
