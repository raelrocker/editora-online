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
$factory->define(\CodePub\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(CodePub\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => ucfirst($faker->unique()->word),
    ];
});

$factory->define(\CodePub\Models\Book::class, function (Faker\Generator $faker) {
    $repository = app(\CodePub\Repositories\UserRepository::class);
    $userId = $repository->all()->random()->id;
    return [
        'title' => ucfirst($faker->unique()->text(20)),
        'subtitle' => ucfirst($faker->unique()->text(15)),
        'price' => $faker->randomFloat(2, 10, 200),
        'user_id' => $userId
    ];
});

