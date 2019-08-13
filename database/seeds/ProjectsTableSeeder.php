<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;
use App\Project;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $faker;

    public function __construct(Faker $faker)
    {
        $this->faker = $faker;
    }

    public function run()
    {
        $users = App\User::all();
        factory(App\Project::class, 15)->create();
        App\Project::all()->each(function ($project) use ($users) {
            $project->users()->attach( $users->random()->id,
                ['project_id' => $this->faker->numberBetween(1, 15), 'start_date' => now(), 'end_date' => now()]
            );
        });
    }
}
