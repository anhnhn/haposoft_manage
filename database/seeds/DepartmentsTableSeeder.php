<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\User;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Department::class, 5)->create();
    }
}
