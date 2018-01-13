<?php

use Faker\Generator as Faker;

$factory->define(App\Like::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 100),
        'post_id' => $faker->numberBetween(1, 100),
        'comment_id' => $faker->numberBetween(1, 100),
    ];
});
