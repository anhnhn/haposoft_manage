<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Report;
use Faker\Generator as Faker;

$factory->define(Report::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'content' => $faker->text,
        'user_id' => App\Models\User::all()->random()->id
    ];
});
