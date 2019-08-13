<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Report;
use Faker\Generator as Faker;

$factory->define(\App\Report::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'content' => $faker->text,
        'user_id' => App\User::all()->random()->id
    ];
});
