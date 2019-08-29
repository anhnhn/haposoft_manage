<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'start_date' => now(),
        'end_date' => now(),
        'customer_id' => App\Models\Customer::all()->random()->id
    ];
});
