<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Photo;
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

$factory->define(Photo::class, function (Faker $faker) {
    return [
        'article_id'      => Article::all()->random()->id,
        'photo'           => $faker->imageUrl($width=800, $height=500, 'cats'),
        'is_thumbnail'   => $faker->numberBetween(0, 1),
        'created_at'     => now(),
        'updated_at'     => now(),
    ];
});
