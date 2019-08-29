<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models;
use Faker\Generator as Faker;

$factory->define(Models\Department::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'created_at' => now()
    ];
});
