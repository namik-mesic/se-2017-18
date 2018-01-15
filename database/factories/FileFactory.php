<?php

use Faker\Generator as Faker;

$factory->define(App\File::class, function (Faker $faker) {
    return [
        'user_id' => $faker-> numberBetween(700,950),
        'group_id' => $faker->numberBetween(1800,2200),
        'file_url' => $faker->text(50)
    ];
});
