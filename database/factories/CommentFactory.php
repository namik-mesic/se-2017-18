<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 100),
        'post_id' => $faker->numberBetween(1, 100),
        'text' => $faker->text(100),
    ];
});
