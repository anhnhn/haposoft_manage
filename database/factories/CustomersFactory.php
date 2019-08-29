<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\Customer;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('password'),
        'remember_token' => Str::random(10),
        'address' => $faker->address,
        'created_at' => now(),
        'phone' => $faker->phoneNumber
    ];
});
