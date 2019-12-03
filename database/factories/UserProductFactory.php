<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserProduct;
use Faker\Generator as Faker;

$factory->define(UserProduct::class, function (Faker $faker) {
    return [
        'quantity' => $faker->randomFloat(NULL, 1, 10),
        'user_id' => App\User::all()->random()->id,
        'product_id' => App\Product::all()->random()->id,
    ];
});
