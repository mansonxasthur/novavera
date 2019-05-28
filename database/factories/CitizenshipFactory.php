<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Citizenship;
use Faker\Generator as Faker;

$factory->define(Citizenship::class, function (Faker $faker) {
    return [
        'country_name' => $faker->country,
        'title' => $title = $faker->name,
        'slug' => $title,
        'type' => $faker->randomElement(['citizenship', 'residency', 'both']),
        'dropdown_flag' => $faker->imageUrl(),
        'body_flag' => $faker->imageUrl(),
        'header' => $faker->imageUrl(),
        'description' =>$faker->text,
        'snippet' =>$faker->text,
    ];
});
