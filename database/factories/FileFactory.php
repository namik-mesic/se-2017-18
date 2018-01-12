<?php

use Faker\Generator as Faker;

$factory->define(App\File::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(500, 800),
        'group_id' => $faker->numberBetween(1200, 2000),
        'file_url' => $faker->text(50)
    ];
});
