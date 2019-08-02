<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Article;
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

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title'         => $faker->sentence,
        'body'          => $faker->paragraph,
        'thumbnail'     => $faker->imageUrl($width=800, $height=500, 'cats'),
        'city'          => $faker->randomElement(['gjakove', 'prishtine','mitrovice','peje','prizren','gjilan','ferizaj']),
        'address'       => $faker->address,
        'for'           => $faker->randomElement(['rent', 'sale']),
        'price'         => $faker->randomFloat($nbMaxDecimals = null, $min = 50, $max = 100000),
        'views'         => $faker->numberBetween($min = 0, $max = 2000),
        'type'          => $faker->numberBetween(1, 5) . '+' . $faker->numberBetween(1, 2),
        'available'     => $faker->numberBetween(0, 1),
        'phonenumber'   => $faker->tollFreePhoneNumber,
        'created_at'    => now(),
        'updated_at'    => now(),
    ];
});
