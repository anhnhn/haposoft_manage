<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(\App\Task::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'content' => $faker->text,
        'hours' => $faker->numberBetween(1,30),
        'user_id' => App\User::all()->random()->id,
        'project_id' => App\Project::all()->random()->id
    ];
});
