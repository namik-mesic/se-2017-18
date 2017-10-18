<?php
/**
 * Created by PhpStorm.
 * User: Magnus
 * Date: 11-Oct-17
 * Time: 23:53
 */
use Faker\Generator as Faker;

/**
 *
 */

$factory->define(App\Offer::class, function (Faker $faker) {
    return [
    'meal' => $faker->name,
    'ingredients'=> $faker->words,
    'cost'=> $faker->randomDigitNotNull,
    ];
});