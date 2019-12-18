<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Image;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
    $imageNames = ['223226-cv.jpg','225451-max-nelson-748763-unsplash.jpg','231346-photo-1574799230574-a98b7f81c361.jpg'];
    return [
        'name' => $imageNames[rand(0,2)],
        'product_id' => App\Product::all()->random()->id,
    ];
});
