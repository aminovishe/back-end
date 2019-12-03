<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'label' => $faker->title,
        'price' => $faker->randomFloat(NULL, 1, 10000),
        'quantity' => $faker->randomFloat(NULL, 200, 1000),
    ];
});
