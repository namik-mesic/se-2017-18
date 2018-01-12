<?php

use Faker\Generator as Faker;

$factory->define(App\Group::class, function (Faker $faker) {
    return [

        'name' => $faker->name,
        'description' => $faker->text(200),
        'image_url' => $faker->text(50)
    ];
});
