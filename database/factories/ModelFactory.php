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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'api_token' => str_random(20),
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Tickets::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentences(1),
        'category_id' => $faker->numberBetween(1, 3),
        'platform' => $faker->name,
        'description' => $faker->sentences(3),
        'creator_email' => $faker->email,
        'creator_name' => $faker->name,
    ];
});