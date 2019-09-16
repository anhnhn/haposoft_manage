<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Admin;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'name' => 'admin111',
        'email' => 'admin@gmail.com',
        'password' => bcrypt('123456'),
        'remember_token' => Str::random(10)
    ];
});
