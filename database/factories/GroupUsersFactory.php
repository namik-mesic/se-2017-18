<?php

use Faker\Generator as Faker;

$factory->define(App\GroupUser::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 100),
        'group_id' => $faker->numberBetween(1, 100),
        'privilege' => $faker->randomElement(['yes', 'no', 'admin'])
    ];
});
