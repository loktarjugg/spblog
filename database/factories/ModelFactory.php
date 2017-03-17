<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;
    return [
        'name' => $faker->name,
        'avatar' => $faker->imageUrl(180,180),
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Models\Article::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'slug' => $faker->slug(rand(3,5)),
        'cover' => $faker->imageUrl(),
        'qrcode' => $faker->imageUrl(400 , 400),
        'original_body' => $faker->paragraphs(12,true),
        'body'  => $faker->paragraphs(12,true),
        'vote_count' => rand(1,200),
        'view_count' => rand(1,200)
    ];
});

$factory->define(App\Models\Share::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->words(3,true),
        'logo'  => $faker->imageUrl(120,120),
        'content' => $faker->sentences(1,true),
        'link'  => $faker->url
    ];
});

