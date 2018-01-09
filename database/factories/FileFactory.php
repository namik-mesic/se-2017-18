<?php

use Faker\Generator as Faker;

$factory->define(App\File::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 100),
        'group_id' => $faker->numberBetween(1, 100),
        'file_url' => $faker->text(50)
    ];
});
