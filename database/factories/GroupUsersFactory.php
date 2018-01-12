<?php

use Faker\Generator as Faker;

$factory->define(App\GroupUser::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(400, 1000),
        'group_id' => $faker->numberBetween(1200, 2000),
        'privilege' => $faker->randomElement(['yes', 'no', 'admin'])
    ];
});
