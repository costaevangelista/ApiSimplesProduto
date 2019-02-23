<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
 */

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->lastName,
        'sku' => rand(1, 99999),
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true)
    ];
});
