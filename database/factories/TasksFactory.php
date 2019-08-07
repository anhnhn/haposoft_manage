<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'content' => $faker->text,
        'hours' => $faker->numberBetween(1,30),
        'user_id' => App\Models\User::all()->random()->id,
        'project_id' => App\Models\Project::all()->random()->id
    ];
});
